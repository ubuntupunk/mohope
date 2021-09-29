<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:44:43
  from "/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/controllers/preferences/helpers/options/options.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e333b0aa728_04813951',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7bac7afd0bc8060b4d879139a945f6e29c8c755d' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/controllers/preferences/helpers/options/options.tpl',
      1 => 1564078910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e333b0aa728_04813951 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44164816603e333b0a2857_23972462', "input");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/options/options.tpl");
}
/* {block "input"} */
class Block_44164816603e333b0a2857_23972462 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_44164816603e333b0a2857_23972462',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'disabled') {?>
		<?php echo $_smarty_tpl->tpl_vars['field']->value['disabled'];?>

	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this);
?>

	<?php }
}
}
/* {/block "input"} */
}
