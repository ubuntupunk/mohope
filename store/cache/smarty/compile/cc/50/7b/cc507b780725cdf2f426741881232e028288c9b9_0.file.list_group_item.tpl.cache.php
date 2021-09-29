<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcategories/list_group_item.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239d35c68_40674695',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc507b780725cdf2f426741881232e028288c9b9' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcategories/list_group_item.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./list_group_item.tpl' => 2,
  ),
),false)) {
function content_603e3239d35c68_40674695 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1594295507603e3239d24320_93221509';
?>

<?php if (!empty($_smarty_tpl->tpl_vars['list_item']->value['children'])) {?>
  <?php $_smarty_tpl->_assignInScope('list_item_id', ('ct-').($_smarty_tpl->tpl_vars['list_item']->value['id']));
?>
  <div class="list-group-item-wrapper<?php if ((isset($_smarty_tpl->tpl_vars['currentCategoryId']->value) && $_smarty_tpl->tpl_vars['list_item']->value['id'] == $_smarty_tpl->tpl_vars['currentCategoryId']->value) || (!empty($_smarty_tpl->tpl_vars['list_item']->value['expanded']) && $_smarty_tpl->tpl_vars['list_item']->value['expanded'])) {?> active<?php }?>">
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list_item']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" class="list-group-item ilvl-<?php echo intval($_smarty_tpl->tpl_vars['level']->value);
if (isset($_smarty_tpl->tpl_vars['currentCategoryId']->value) && $_smarty_tpl->tpl_vars['list_item']->value['id'] == $_smarty_tpl->tpl_vars['currentCategoryId']->value) {?> current<?php }?>">
      <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list_item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
    </a>
    <a class="btn-toggle<?php if (empty($_smarty_tpl->tpl_vars['list_item']->value['expanded'])) {?> collapsed<?php }?> ilvl-<?php echo intval($_smarty_tpl->tpl_vars['level']->value);?>
" href="#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list_item_id']->value, ENT_QUOTES, 'UTF-8', true);?>
" data-toggle="collapse" title="<?php echo smartyTranslate(array('s'=>'Expand/Collapse','mod'=>'blockcategories'),$_smarty_tpl);?>
">
      <i class="icon icon-caret-up"></i>
    </a>
  </div>
  <div <?php if (empty($_smarty_tpl->tpl_vars['list_item']->value['expanded'])) {?> class="list-group collapse" style="height: 0px;"<?php } else { ?> class="list-group collapse in" style="height: auto;"<?php }?> id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list_item_id']->value, ENT_QUOTES, 'UTF-8', true);?>
">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_item']->value['children'], 'list_item_child');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['list_item_child']->value) {
?>
      <?php $_smarty_tpl->_subTemplateRender("file:./list_group_item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array('list_item'=>$_smarty_tpl->tpl_vars['list_item_child']->value,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), 0, true);
?>

    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

  </div>
<?php } else { ?>
  <a class="list-group-item ilvl-<?php echo intval($_smarty_tpl->tpl_vars['level']->value);
if (isset($_smarty_tpl->tpl_vars['currentCategoryId']->value) && $_smarty_tpl->tpl_vars['list_item']->value['id'] == $_smarty_tpl->tpl_vars['currentCategoryId']->value) {?> active current<?php }?>" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list_item']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
">
    <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['list_item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
  </a>
<?php }
}
}
