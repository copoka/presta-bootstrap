<?php /* Smarty version Smarty-3.1.11, created on 2012-11-29 00:09:07
         compiled from "C:\wamp\www\presta-bootstrap\modules\blockadvertising\blockadvertising.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162850b6999303b3d2-17761345%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d824b025489fd74878c0fe6cd9738a1ff5b748a' => 
    array (
      0 => 'C:\\wamp\\www\\presta-bootstrap\\modules\\blockadvertising\\blockadvertising.tpl',
      1 => 1354142597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162850b6999303b3d2-17761345',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'adv_link' => 0,
    'adv_title' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b6999307e131_27063956',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b6999307e131_27063956')) {function content_50b6999307e131_27063956($_smarty_tpl) {?>

<!-- MODULE Block advertising -->
<div class="advertising_block">
	<a href="<?php echo $_smarty_tpl->tpl_vars['adv_link']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['adv_title']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['adv_title']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['adv_title']->value;?>
" width="155"  height="163" /></a>
</div>
<!-- /MODULE Block advertising -->
<?php }} ?>