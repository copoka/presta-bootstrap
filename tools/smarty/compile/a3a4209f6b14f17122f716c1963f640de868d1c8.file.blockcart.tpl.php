<?php /* Smarty version Smarty-3.1.11, created on 2012-11-29 00:09:07
         compiled from "C:\wamp\www\presta-bootstrap\modules\blockcart\blockcart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3145750b69993d271c3-86842050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3a4209f6b14f17122f716c1963f640de868d1c8' => 
    array (
      0 => 'C:\\wamp\\www\\presta-bootstrap\\modules\\blockcart\\blockcart.tpl',
      1 => 1354142597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3145750b69993d271c3-86842050',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ajax_allowed' => 0,
    'CUSTOMIZE_TEXTFIELD' => 0,
    'link' => 0,
    'colapseExpandStatus' => 0,
    'cart_qties' => 0,
    'priceDisplay' => 0,
    'cart' => 0,
    'products' => 0,
    'product' => 0,
    'productId' => 0,
    'productAttributeId' => 0,
    'customizedDatas' => 0,
    'static_token' => 0,
    'id_customization' => 0,
    'customization' => 0,
    'discounts' => 0,
    'discount' => 0,
    'img_dir' => 0,
    'shipping_cost' => 0,
    'show_wrapping' => 0,
    'blockcart_cart_flag' => 0,
    'show_tax' => 0,
    'tax_cost' => 0,
    'total' => 0,
    'use_taxes' => 0,
    'display_tax_label' => 0,
    'order_process' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b69994869902_29491175',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b69994869902_29491175')) {function content_50b69994869902_29491175($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\presta-bootstrap\\tools\\smarty\\plugins\\modifier.escape.php';
if (!is_callable('smarty_modifier_replace')) include 'C:\\wamp\\www\\presta-bootstrap\\tools\\smarty\\plugins\\modifier.replace.php';
?>




<?php if ($_smarty_tpl->tpl_vars['ajax_allowed']->value){?>
<script type="text/javascript">
var CUSTOMIZE_TEXTFIELD = <?php echo $_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value;?>
;
var customizationIdMessage = '<?php echo smartyTranslate(array('s'=>'Customization #','mod'=>'blockcart','js'=>1),$_smarty_tpl);?>
';
var removingLinkText = '<?php echo smartyTranslate(array('s'=>'remove this product from my cart','mod'=>'blockcart','js'=>1),$_smarty_tpl);?>
';
</script>
<?php }?>

<!-- MODULE Block cart -->
<div id="cart_block" class="block exclusive">
	<h4>
		<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value).".php",true);?>
"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl);?>
</a>
		<?php if ($_smarty_tpl->tpl_vars['ajax_allowed']->value){?>
		<span id="block_cart_expand" <?php if (isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)&&$_smarty_tpl->tpl_vars['colapseExpandStatus']->value=='expanded'||!isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)){?>class="hidden"<?php }?>>&nbsp;</span>
		<span id="block_cart_collapse" <?php if (isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)&&$_smarty_tpl->tpl_vars['colapseExpandStatus']->value=='collapsed'){?>class="hidden"<?php }?>>&nbsp;</span>
		<?php }?>
	</h4>
	<div class="block_content">
	<!-- block summary -->
	<div id="cart_block_summary" class="<?php if (isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)&&$_smarty_tpl->tpl_vars['colapseExpandStatus']->value=='expanded'||!$_smarty_tpl->tpl_vars['ajax_allowed']->value||!isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)){?>collapsed<?php }else{ ?>expanded<?php }?>">
		<span class="ajax_cart_quantity" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value<=0){?>style="display:none;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['cart_qties']->value;?>
</span>
		<span class="ajax_cart_product_txt_s" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value<=1){?>style="display:none"<?php }?>><?php echo smartyTranslate(array('s'=>'products','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
		<span class="ajax_cart_product_txt" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value>1){?>style="display:none"<?php }?>><?php echo smartyTranslate(array('s'=>'product','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
		<span class="ajax_cart_total" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value<=0){?>style="display:none"<?php }?>><?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false)),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true)),$_smarty_tpl);?>
<?php }?></span>
		<span class="ajax_cart_no_product" <?php if ($_smarty_tpl->tpl_vars['cart_qties']->value!=0){?>style="display:none"<?php }?>><?php echo smartyTranslate(array('s'=>'(empty)','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
	</div>
	<!-- block list of products -->
	<div id="cart_block_list" class="<?php if (isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)&&$_smarty_tpl->tpl_vars['colapseExpandStatus']->value=='expanded'||!$_smarty_tpl->tpl_vars['ajax_allowed']->value||!isset($_smarty_tpl->tpl_vars['colapseExpandStatus']->value)){?>expanded<?php }else{ ?>collapsed<?php }?>">
	<?php if ($_smarty_tpl->tpl_vars['products']->value){?>
		<dl class="products">
		<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
			<?php $_smarty_tpl->tpl_vars['productId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product'], null, 0);?>
			<?php $_smarty_tpl->tpl_vars['productAttributeId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], null, 0);?>
			<dt id="cart_block_product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']){?>_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
<?php }?>" class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']){?>last_item<?php }else{ ?>item<?php }?>">
				<span class="quantity-formated"><span class="quantity"><?php echo $_smarty_tpl->tpl_vars['product']->value['cart_quantity'];?>
</span>x</span>
				<a class="cart_block_product_name" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']);?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'], 'html', 'UTF-8');?>
">
				<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],13,'...'), 'html', 'UTF-8');?>
</a>
				<span class="remove_link"><?php if (!isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value])){?><a rel="nofollow" class="ajax_cart_block_remove_link" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart.php');?>
?delete&amp;id_product=<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
&amp;ipa=<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
&amp;token=<?php echo $_smarty_tpl->tpl_vars['static_token']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'remove this product from my cart','mod'=>'blockcart'),$_smarty_tpl);?>
">&nbsp;</a><?php }?></span>
				<span class="price"><?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==@PS_TAX_EXC){?><?php echo Product::displayWtPrice(array('p'=>((string)$_smarty_tpl->tpl_vars['product']->value['total'])),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::displayWtPrice(array('p'=>((string)$_smarty_tpl->tpl_vars['product']->value['total_wt'])),$_smarty_tpl);?>
<?php }?></span>
			</dt>
			<?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?>
			<dd id="cart_block_combination_of_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']){?>_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
<?php }?>" class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']){?>last_item<?php }else{ ?>item<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['attributes_small'];?>
</a>
			<?php }?>

			<!-- Customizable datas -->
			<?php if (isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value])){?>
				<?php if (!isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?><dd id="cart_block_combination_of_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']){?>_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
<?php }?>" class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']){?>last_item<?php }else{ ?>item<?php }?>"><?php }?>
				<ul class="cart_block_customizations" id="customization_<?php echo $_smarty_tpl->tpl_vars['productId']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['productAttributeId']->value;?>
">
					<?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization']->_loop = false;
 $_smarty_tpl->tpl_vars['id_customization'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value){
$_smarty_tpl->tpl_vars['customization']->_loop = true;
 $_smarty_tpl->tpl_vars['id_customization']->value = $_smarty_tpl->tpl_vars['customization']->key;
?>
						<li name="customization">
							<div class="deleteCustomizableProduct" id="deleteCustomizableProduct_<?php echo intval($_smarty_tpl->tpl_vars['id_customization']->value);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
"><a class="ajax_cart_block_remove_link" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart.php');?>
?delete&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
&amp;ipa=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
&amp;id_customization=<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
&amp;token=<?php echo $_smarty_tpl->tpl_vars['static_token']->value;?>
"> </a></div>
							<span class="quantity-formated"><span class="quantity"><?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
</span>x</span><?php if (isset($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value][0])){?>
							<?php echo smarty_modifier_truncate(smarty_modifier_replace(smarty_modifier_escape($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value][0]['value'], 'html', 'UTF-8'),"<br />"," "),28);?>

							<?php }else{ ?>
							<?php echo smartyTranslate(array('s'=>'Customization #','mod'=>'blockcart'),$_smarty_tpl);?>
<?php echo intval($_smarty_tpl->tpl_vars['id_customization']->value);?>
<?php echo smartyTranslate(array('s'=>':','mod'=>'blockcart'),$_smarty_tpl);?>

							<?php }?>
						</li>
					<?php } ?>
				</ul>
				<?php if (!isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?></dd><?php }?>
			<?php }?>

			<?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?></dd><?php }?>

		<?php } ?>
		</dl>
	<?php }?>
		<p <?php if ($_smarty_tpl->tpl_vars['products']->value){?>class="hidden"<?php }?> id="cart_block_no_products"><?php echo smartyTranslate(array('s'=>'No products','mod'=>'blockcart'),$_smarty_tpl);?>
</p>

		<?php if (count($_smarty_tpl->tpl_vars['discounts']->value)>0){?><table id="vouchers">
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['discount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['discount']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['discounts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['discount']->key => $_smarty_tpl->tpl_vars['discount']->value){
$_smarty_tpl->tpl_vars['discount']->_loop = true;
?>
				<tr class="bloc_cart_voucher" id="bloc_cart_voucher_<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
">
					<td class="name" title="<?php echo $_smarty_tpl->tpl_vars['discount']->value['description'];?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate((($_smarty_tpl->tpl_vars['discount']->value['name']).(' : ')).($_smarty_tpl->tpl_vars['discount']->value['description']),18,'...'), 'htmlall', 'UTF-8');?>
</td>
					<td class="price">-<?php if ($_smarty_tpl->tpl_vars['discount']->value['value_real']!='!'){?><?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']),$_smarty_tpl);?>
<?php }?><?php }?></td>
					<td class="delete"><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value).".php",true);?>
?deleteDiscount=<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
" title="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" width="11" height="13" class="icon" /></a></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php }?>

		<p id="cart-prices">
			<span><?php echo smartyTranslate(array('s'=>'Shipping','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
			<span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost"><?php echo $_smarty_tpl->tpl_vars['shipping_cost']->value;?>
</span>
			<br/>
			<?php if ($_smarty_tpl->tpl_vars['show_wrapping']->value){?>
				<?php $_smarty_tpl->tpl_vars['blockcart_cart_flag'] = new Smarty_variable(constant('Cart::ONLY_WRAPPING'), null, 0);?>
				<span><?php echo smartyTranslate(array('s'=>'Wrapping','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
				<span id="cart_block_wrapping_cost" class="price cart_block_wrapping_cost"><?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(false,$_smarty_tpl->tpl_vars['blockcart_cart_flag']->value)),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['cart']->value->getOrderTotal(true,$_smarty_tpl->tpl_vars['blockcart_cart_flag']->value)),$_smarty_tpl);?>
<?php }?></span>
				<br/>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['show_tax']->value&&isset($_smarty_tpl->tpl_vars['tax_cost']->value)){?>
				<span><?php echo smartyTranslate(array('s'=>'Tax','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
				<span id="cart_block_tax_cost" class="price ajax_cart_tax_cost"><?php echo $_smarty_tpl->tpl_vars['tax_cost']->value;?>
</span>
				<br/>
			<?php }?>
			<span><?php echo smartyTranslate(array('s'=>'Total','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
			<span id="cart_block_total" class="price ajax_block_cart_total"><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</span>
		</p>
		<?php if ($_smarty_tpl->tpl_vars['use_taxes']->value&&$_smarty_tpl->tpl_vars['display_tax_label']->value==1&&$_smarty_tpl->tpl_vars['show_tax']->value){?>
			<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==0){?>
				<p id="cart-price-precisions">
					<?php echo smartyTranslate(array('s'=>'Prices are tax included','mod'=>'blockcart'),$_smarty_tpl);?>

				</p>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==1){?>
				<p id="cart-price-precisions">
					<?php echo smartyTranslate(array('s'=>'Prices are tax excluded','mod'=>'blockcart'),$_smarty_tpl);?>

				</p>
			<?php }?>
		<?php }?>
		<p id="cart-buttons">
			<?php if ($_smarty_tpl->tpl_vars['order_process']->value=='order'){?><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value).".php",true);?>
" class="button_small" title="<?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl);?>
</a><?php }?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value).".php",true);?>
<?php if ($_smarty_tpl->tpl_vars['order_process']->value=='order'){?>?step=1<?php }?>" id="button_order_cart" class="exclusive<?php if ($_smarty_tpl->tpl_vars['order_process']->value=='order-opc'){?>_large<?php }?>" title="<?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
</a>
		</p>
	</div>
	</div>
</div>
<!-- /MODULE Block cart -->

<?php }} ?>