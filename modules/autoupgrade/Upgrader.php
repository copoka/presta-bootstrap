<?php
/*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision: 16859 $
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class UpgraderCore
{
	const DEFAULT_CHECK_VERSION_DELAY_HOURS = 24;
	const DEFAULT_CHANNEL = 'minor';
	// @todo channel handling :)
	public $addons_api = 'api.addons.prestashop.com';
	public $rss_channel_link = 'http://api.prestashop.com/xml/channel.xml';
	public $rss_md5file_link_dir = 'http://api.prestashop.com/xml/md5/';
	/**
	 * @var boolean contains true if last version is not installed
	 */
	private $need_upgrade = false;
	private $changed_files = array();
	private $missing_files = array();

	public $version_name;
	public $version_num;
	public $version_is_modified = null;
	/**
	 * @var string contains hte url where to download the file
	 */
	public $link;
	public $autoupgrade;
	public $autoupgrade_module;
	public $autoupgrade_last_version;
	public $autoupgrade_module_link;
	public $changelog;
	public $available;
	public $md5;

	public static $default_channel = 'minor';
	public $channel = '';
	public $branch = '';

	public function __construct($autoload = false)
	{
		if ($autoload)
		{
			$matches = array();
			preg_match('#([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+#', _PS_VERSION_, $matches);
			$this->branch = $matches[1];
			if (class_exists('Configuration', false))
				$this->channel = Configuration::get('PS_UPGRADE_CHANNEL');
			if (empty($this->channel))
				$this->channel = Upgrader::$default_channel;
			// checkPSVersion to get need_upgrade
			$this->checkPSVersion();
		}
	}
	public function __get($var)
	{
		if ($var == 'need_upgrade')
			return $this->isLastVersion();
	}

	/**
	 * downloadLast download the last version of PrestaShop and save it in $dest/$filename
	 * 
	 * @param string $dest directory where to save the file
	 * @param string $filename new filename
	 * @return boolean
	 *
	 * @TODO ftp if copy is not possible (safe_mode for example)
	 */
	public function downloadLast($dest, $filename = 'prestashop.zip')
	{
		if (empty($this->link))
			$this->checkPSVersion();

		$destPath = realpath($dest).DIRECTORY_SEPARATOR.$filename;
		if (@copy($this->link, $destPath))
			return true;
		else
			return false;
	}
	public function isLastVersion()
	{
		if (empty($this->link))
			$this->checkPSVersion();
		return $this->need_upgrade;

	}

	/**
	 * checkPSVersion ask to prestashop.com if there is a new version. return an array if yes, false otherwise
	 * 
	 * @param boolean $refresh if set to true, will force to download channel.xml
	 * @param array $array_no_major array of channels which will return only the immediate next version number.
	 *
	 * @return mixed
	 */
	public function checkPSVersion($refresh = false, $array_no_major = array('minor'))
	{
		// if we use the autoupgrade process, we will never refresh it
		// except if no check has been done before
		$feed = $this->getXmlChannel($refresh);
		$branch_name = '';
		$channel_name = '';

		// channel hierarchy :
		// if you follow private, you follow stable release
		// if you follow rc, you also follow stable
		// if you follow beta, you also follow rc
		// et caetera
		$followed_channels = array();
		$followed_channels[] = $this->channel;
		switch($this->channel)
		{
		case 'alpha':
			$followed_channels[] = 'beta';
		case 'beta':
			$followed_channels[] = 'rc';
		case 'rc':
			$followed_channels[] = 'stable';
		case 'minor':
		case 'major':
		case 'private':
			$followed_channels[] = 'stable';
		}

		if ($feed)
		{
			$this->autoupgrade_module = (int)$feed->autoupgrade_module;
			$this->autoupgrade_last_version = (string)$feed->autoupgrade->last_version;
			$this->autoupgrade_module_link = (string)$feed->autoupgrade->download->link;

			foreach ($feed->channel as $channel)
			{
				$channel_available = (string)$channel['available'];

				$channel_name = (string)$channel['name'];
				// stable means major and minor
				// boolean algebra 
				// skip if one of theses props are true:
				// - "stable" in xml, "minor" or "major" in configuration
				// - channel in xml is not channel in configuration
				if (!(in_array($channel_name, $followed_channels)))
					continue;
				// now we are on the correct channel (minor, major, ...)
				foreach ($channel as $branch)
				{
					// branch name = which version 
					$branch_name = (string)$branch['name'];
					// if channel is "minor" in configuration, do not allow something else than current branch
					// otherwise, allow superior or equal
					if (
						(in_array($this->channel, $followed_channels) 
						&& version_compare($branch_name, $this->branch, '>='))
					)
					{
						// skip if $branch->num is inferior to a previous one, skip it
						if (version_compare((string)$branch->num, $this->version_num, '<'))
							continue;
						// also skip if previous loop found an available upgrade and current is not
						if ($this->available && !($channel_available && (string)$branch['available']))
							continue;
						// also skip if chosen channel is minor, and xml branch name is superior to current
						if (in_array($this->channel, $array_no_major) && version_compare($branch_name, $this->branch, '>'))
							continue;
						$this->version_name = (string)$branch->name;
						$this->version_num = (string)$branch->num;
						$this->link = (string)$branch->download->link;
						$this->md5 = (string)$branch->download->md5;
						$this->changelog = (string)$branch->download->changelog;
						$this->available = $channel_available && (string)$branch['available'];
					}
				}
			}
		}
		else
			return false;
		// retro-compatibility :
		// return array(name,link) if you don't use the last version
		// false otherwise
		if (version_compare(_PS_VERSION_, $this->version_num, '<'))
		{
			$this->need_upgrade = true;
			return array('name' => $this->version_name, 'link' => $this->link);
		}
		else
			return false;
	}


	/**
	 * delete the file /config/xml/$version.xml if exists
	 * 
	 * @param string $version
	 * @return boolean true if succeed
	 */
	public function clearXmlMd5File($version)
	{
		$filename = _PS_ROOT_DIR_.'/config/xml/'.$version.'.xml';
		if (file_exists($filename))
			return unlink ($filename);
		return true;
	}

	/**
	 * use the addons api to get xml files
	 * 
	 * @param mixed $xml_localfile 
	 * @param mixed $postData 
	 * @param mixed $refresh 
	 * @access public
	 * @return void
	 */
	public function getApiAddons($xml_localfile, $postData, $refresh = false)
	{
		if (!is_dir(_PS_ROOT_DIR_.'/config/xml'))
		{
			if (is_file(_PS_ROOT_DIR_.'/config/xml'))
				unlink(_PS_ROOT_DIR_.'/config/xml');
			mkdir(_PS_ROOT_DIR_.'/config/xml', 0777);
		}
		$delay = (3600 * Upgrader::DEFAULT_CHECK_VERSION_DELAY_HOURS);
		if ($refresh || !file_exists($xml_localfile) || filemtime($xml_localfile) < (time() - $delay))
		{
			$protocolsList = array('https://' => 443, 'http://' => 80);

			// Make the request
			$opts = array(
				'http'=>array(
				'method'=> 'POST',
				'content' => $postData,
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'timeout' => 5,
			));
			$context = stream_context_create($opts);
			foreach ($protocolsList as $protocol => $port)
			{
				$xml_string = file_get_contents($protocol.$this->addons_api, false, $context);
				if ($xml_string)
				{
					$xml = @simplexml_load_string($xml_string);
					break;
				}
			}
			if ($xml !== false)
				file_put_contents($xml_localfile, $xml_string);
		}
		else
			$xml = @simplexml_load_file($xml_localfile);
		return $xml;
	}

	public function getXmlFile($xml_localfile, $xml_remotefile, $refresh = false)
	{
		// @TODO : this has to be moved in autoupgrade.php > install method
		if (!is_dir(_PS_ROOT_DIR_.'/config/xml'))
		{
			if (is_file(_PS_ROOT_DIR_.'/config/xml'))
				unlink(_PS_ROOT_DIR_.'/config/xml');
			mkdir(_PS_ROOT_DIR_.'/config/xml', 0777);
		}
		$delay = (3600 * Upgrader::DEFAULT_CHECK_VERSION_DELAY_HOURS);
		if ($refresh || !file_exists($xml_localfile) || filemtime($xml_localfile) < (time() - $delay))
		{
			// @ to hide errors if md5 file is not reachable
			$xml_string = @file_get_contents($xml_remotefile, false, 
				stream_context_create(array('http' => array('timeout' => 3))));
			$xml = @simplexml_load_string($xml_string);
			if ($xml !== false)
				file_put_contents($xml_localfile, $xml_string);
		}
		else
			$xml = @simplexml_load_file($xml_localfile);
		return $xml;
	}

	public function getXmlChannel($refresh = false)
	{
		$xml_local = _PS_ROOT_DIR_.'/config/xml/channel.xml';
		$xml_remote = $this->rss_channel_link;
		$xml = $this->getXmlFile($xml_local, $xml_remote, $refresh);
		if ($refresh)
		{
			if (class_exists('Configuration', false))
				Configuration::updateValue('PS_LAST_VERSION_CHECK', time());
		}
		return $xml;
	}

	/**
	 * return xml containing the list of all default PrestaShop files for version $version, 
	 * and their respective md5sum
	 * 
	 * @param string $version 
	 * @return SimpleXMLElement or false if error
	 */
	public function getXmlMd5File($version, $refresh = false)
	{
		$xml_local = _PS_ROOT_DIR_.'/config/xml/'.$version.'.xml';
		$xml_remote = $this->rss_md5file_link_dir.$version.'.xml';
		return $this->getXmlFIle($xml_local, $xml_remote, $refresh);
	}

	/**
	 * returns an array of files which are present in PrestaShop version $version and has been modified 
	 * in the current filesystem.
	 * @return array of string> array of filepath
	 */
	public function getChangedFilesList($version = null, $refresh = false)
	{
		if (empty($version))
			$version = _PS_VERSION_;
		if (is_array($this->changed_files) && count($this->changed_files) == 0)
		{
			$checksum = $this->getXmlMd5File($version, $refresh);
			if ($checksum == false)
			{
				$this->changed_files = false;
			}
			else
				$this->browseXmlAndCompare($checksum->ps_root_dir[0]);
		}
		return $this->changed_files;
	}

	/** populate $this->changed_files with $path
	 * in sub arrays  mail, translation and core items 
	 * @param string $path filepath to add, relative to _PS_ROOT_DIR_
	 */
	protected function addChangedFile($path)
	{
		$this->version_is_modified = true;
		
		if (strpos($path, 'mails/') !== false)
			$this->changed_files['mail'][] = $path;
		else if (
			strpos($path, '/en.php') !== false
			|| strpos($path, '/fr.php') !== false
			|| strpos($path, '/es.php') !== false
			|| strpos($path, '/it.php') !== false
			|| strpos($path, '/de.php') !== false
			|| strpos($path, 'translations/') !== false
		)
			$this->changed_files['translation'][] = $path;
		else
			$this->changed_files['core'][] = $path;
	}

	/** populate $this->missing_files with $path
	 * @param string $path filepath to add, relative to _PS_ROOT_DIR_
	 */
	protected function addMissingFile($path)
	{
		$this->version_is_modified = true;
		$this->missing_files[] = $path;
	}

	
	public function md5FileAsArray($node, $dir = '/')
	{
		$array = array();
		foreach ($node as $key => $child)
		{
			if (is_object($child) && $child->getName() == 'dir')
			{
				$dir = (string)$child['name'];
				// $current_path = $dir.(string)$child['name'];
				// @todo : something else than array pop ?
				$dir_content = $this->md5FileAsArray($child, $dir);
				$array[$dir] = $dir_content;
			}
			else if (is_object($child) && $child->getName() == 'md5file')
				$array[(string)$child['name']] = (string)$child;
		}
		return $array;
	}

	/**
	 * getDiffFilesList 
	 * 
	 * @param string $version1 
	 * @param string $version2 
	 * @param boolean $show_modif 
	 * @return array array('modified'=>array(...), 'deleted'=>array(...))
	 */
	public  function getDiffFilesList($version1, $version2, $show_modif = true, $refresh = false)
	{
		$checksum1 = $this->getXmlMd5File($version1, $refresh);
		$checksum2 = $this->getXmlMd5File($version2, $refresh);
		if ($checksum1)
			$v1 = $this->md5FileAsArray($checksum1->ps_root_dir[0]);
		if ($checksum2)
			$v2 = $this->md5FileAsArray($checksum2->ps_root_dir[0]);
		if (empty($v1) || empty($v2))
			return false;
		$filesList = $this->compareReleases($v1, $v2, $show_modif);
		if (!$show_modif)
			return $filesList['deleted'];
		return $filesList;

	}

	/**
	 * returns an array of files which 
	 * 
	 * @param array $v1 result of method $this->md5FileAsArray()
	 * @param array $v2 result of method $this->md5FileAsArray()
	 * @param boolean $show_modif if set to false, the method will only
	 *   list deleted files 
	 * @param string $path 
	 * 		deleted files in version $v2. Otherwise, only deleted.
	 * @return array('modified' => array(files..), 'deleted' => array(files..)
	 */
	public function compareReleases($v1, $v2, $show_modif = true, $path = '/')
	{
		// in that array the list of files present in v1 deleted in v2
		static $deletedFiles = array();
		// in that array the list of files present in v1 modified in v2
		static $modifiedFiles = array();

		foreach ($v1 as $file => $md5)
		{

			if (is_array($md5))
			{
				$subpath = $path.$file;
				if (isset($v2[$file]) && is_array($v2[$file]))
					$this->compareReleases($md5, $v2[$file], $show_modif, $path.$file.'/');
				else // also remove old dir
					$deletedFiles[] = $subpath;
			}
			else
			{
				if (in_array($file, array_keys($v2)))
				{
					if ($show_modif && ($v1[$file] != $v2[$file]))
						$modifiedFiles[] = $path.$file;
					$exists = true;
				}
				else
					$deletedFiles[] = $path.$file;
			}
		}
		return array('deleted' => $deletedFiles, 'modified' => $modifiedFiles);
	}

	
	/**
	 * Compare the md5sum of the current files with the md5sum of the original 
	 * 
	 * @param mixed $node 
	 * @param array $current_path 
	 * @param int $level 
	 * @return void
	 */
	protected function browseXmlAndCompare($node, &$current_path = array(), $level = 1)
	{
		foreach ($node as $key => $child)
		{
			if (is_object($child) && $child->getName() == 'dir')
			{
				$current_path[$level] = (string)$child['name'];
				$this->browseXmlAndCompare($child, $current_path, $level + 1);
			}
			else if (is_object($child) && $child->getName() == 'md5file')
			{
				// We will store only relative path.
				// absolute path is only used for file_exists and compare
				$relative_path = '';
					for ($i = 1; $i < $level; $i++)
					$relative_path .= $current_path[$i].'/';
				$relative_path .= (string)$child['name'];

				$fullpath = _PS_ROOT_DIR_.DIRECTORY_SEPARATOR.$relative_path;
				$fullpath = str_replace('ps_root_dir', _PS_ROOT_DIR_, $fullpath);

					// replace default admin dir by current one 
				$fullpath = str_replace(_PS_ROOT_DIR_.'/admin', _PS_ADMIN_DIR_, $fullpath);
				if (!file_exists($fullpath))
					$this->addMissingFile($relative_path);
				elseif (!$this->compareChecksum($fullpath, (string)$child) && substr(str_replace(DIRECTORY_SEPARATOR, '-', $relative_path), 0, 19) != 'modules/autoupgrade')
					$this->addChangedFile($relative_path);
					// else, file is original (and ok)
			}
		}
	}

	protected function compareChecksum($filepath, $md5sum)
	{
		if (md5_file($filepath) == $md5sum)
			return true;
		return false;
	}

	public function isAuthenticPrestashopVersion($version = null, $refresh = false)
	{

		$this->getChangedFilesList($version, $refresh);
		return !$this->version_is_modified;
	}

}
