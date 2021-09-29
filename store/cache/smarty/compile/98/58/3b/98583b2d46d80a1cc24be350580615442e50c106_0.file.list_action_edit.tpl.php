<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:42:41
  from "/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/helpers/list/list_action_edit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e32c1258928_99220786',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98583b2d46d80a1cc24be350580615442e50c106' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/helpers/list/list_action_edit.tpl',
      1 => 1564078910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e32c1258928_99220786 (Smarty_Internal_Template $_smarty_tpl) {
?>

<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="edit">
	<i class="icon-pencil"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }
}
