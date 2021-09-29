<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:42:41
  from "/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/helpers/list/list_action_delete.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e32c1261aa7_99669798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5ad51df44e6c76748efc513595d86559af65fcf' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/helpers/list/list_action_delete.tpl',
      1 => 1564078910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e32c1261aa7_99669798 (Smarty_Internal_Template $_smarty_tpl) {
?>

<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)) {?> onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){return true;}else{event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="delete">
	<i class="icon-trash"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }
}
