{*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @version  Release: $Revision: 8088 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<br/>
<fieldset style="width:400px">
  <legend><img src="../img/admin/delivery.gif" alt="" />{l s='Shipping information'}</legend>
  {$var.error}
  <br/>
  {if $var.errorFriendly != ''}
  <p style="color:red">{$var.errorFriendly}</p>
  <br/>
  {/if}
  <form action="{$var.currentIndex}&view{$var.table}&token={$var.token}" method="post" style="margin-top:10px;">
    {if $var.date}
    {l s='You must change the expedition date. Please do not enter holidays date.' mod='tntcarrier'}<br/><br/>
    {l s='Date' mod='tntcarrier'} : <input type="text" value="{$var.date}" name="dateErrorOrder" /><br/><br/>
<input type="submit" value="{l s='Modify' mod='tntcarrier'}" class="button" />
    {/if}
  </form>
</fieldset>