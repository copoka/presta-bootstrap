<?php /* Smarty version Smarty-3.1.11, created on 2012-11-29 00:09:09
         compiled from "C:\wamp\www\presta-bootstrap\themes\prestashop\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2562950b6999527b297-86810573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fce235671c1a4d937059b44aa95bf07eb79c636' => 
    array (
      0 => 'C:\\wamp\\www\\presta-bootstrap\\themes\\prestashop\\footer.tpl',
      1 => 1354142609,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2562950b6999527b297-86810573',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b699952b0530_54934499',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b699952b0530_54934499')) {function content_50b699952b0530_54934499($_smarty_tpl) {?>

		<?php if (!$_smarty_tpl->tpl_vars['content_only']->value){?>
				</div>

<!-- Right -->
				<div id="right_column" class="column">
					<?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>

				</div>
			</div>

<!-- Footer -->
			<div id="footer"><?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>
</div>
		</div>
	<?php }?>
	</body>
</html>
<?php }} ?>