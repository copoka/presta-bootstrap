<?php /*%%SmartyHeaderCode:1003250b69992642833-70278217%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '701a135b6f715cc6609f6d3ebd33011dbaca18a8' => 
    array (
      0 => 'C:\\wamp\\www\\presta-bootstrap\\modules\\blockcategories\\blockcategories.tpl',
      1 => 1354142597,
      2 => 'file',
    ),
    '3c63ba69f0ffd56b5b554c0da998db47e279ad7f' => 
    array (
      0 => 'C:\\wamp\\www\\presta-bootstrap\\modules\\blockcategories\\category-tree-branch.tpl',
      1 => 1354142597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1003250b69992642833-70278217',
  'variables' => 
  array (
    'isDhtml' => 0,
    'blockCategTree' => 0,
    'child' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b699928945c5_47871194',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b699928945c5_47871194')) {function content_50b699928945c5_47871194($_smarty_tpl) {?>
<!-- Block categories module -->
<div id="categories_block_left" class="block">
	<h4>Cat&eacute;gories</h4>
	<div class="block_content">
		<ul class="tree dhtml">
									
<li >
	<a href="http://localhost/presta-bootstrap/category.php?id_category=2"  title="Il est temps, pour le meilleur lecteur de musique, de remonter sur scène pour un rappel. Avec le nouvel iPod, le monde est votre scène.">iPods</a>
	</li>

												
<li >
	<a href="http://localhost/presta-bootstrap/category.php?id_category=3"  title="Tous les accessoires à la mode pour votre iPod">Accessoires</a>
	</li>

												
<li class="last">
	<a href="http://localhost/presta-bootstrap/category.php?id_category=4"  title="Le tout dernier processeur Intel, un disque dur plus spacieux, de la mémoire à profusion et d&#039;autres nouveautés. Le tout, dans à peine 2,59 cm qui vous libèrent de toute entrave. Les nouveaux portables Mac réunissent les performances, la puissance et la connectivité d&#039;un ordinateur de bureau. Sans la partie bureau.">Portables</a>
	</li>

							</ul>
		
		<script type="text/javascript">
		// <![CDATA[
			// we hide the tree only if JavaScript is activated
			$('div#categories_block_left ul.dhtml').hide();
		// ]]>
		</script>
	</div>
</div>
<!-- /Block categories module -->
<?php }} ?>