<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocksupplier/blocksupplier.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239ded1e5_37505988',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87ba23662d1ce48563042347825dc26435e0c5dc' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocksupplier/blocksupplier.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e3239ded1e5_37505988 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1444173201603e3239ddcd08_23844739';
?>
<section>
    <div id="suppliers_block_left" class="block blocksupplier">
        <h2 class="title_block section-title-column">
            <?php if ($_smarty_tpl->tpl_vars['display_link_supplier']->value) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('supplier'), ENT_QUOTES, 'UTF-8', true);?>
"
               title="<?php echo smartyTranslate(array('s'=>'Suppliers','mod'=>'blocksupplier'),$_smarty_tpl);?>
">
                <?php }?>
                <?php echo smartyTranslate(array('s'=>'Suppliers','mod'=>'blocksupplier'),$_smarty_tpl);?>

                <?php if ($_smarty_tpl->tpl_vars['display_link_supplier']->value) {?>
            </a>
            <?php }?>
        </h2>
        <div class="block_content list-block">
            <?php if ($_smarty_tpl->tpl_vars['suppliers']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['text_list']->value) {?>
                    <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['suppliers']->value, 'supplier', false, NULL, 'supplier_list', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['supplier']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_supplier_list']->value['iteration']++;
?>
                            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_supplier_list']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_supplier_list']->value['iteration'] : null) <= $_smarty_tpl->tpl_vars['text_list_nb']->value) {?>
                                <li>
                                    <?php if ($_smarty_tpl->tpl_vars['display_link_supplier']->value) {?>
                                    <a
                                            href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getsupplierLink($_smarty_tpl->tpl_vars['supplier']->value['id_supplier'],$_smarty_tpl->tpl_vars['supplier']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true);?>
"
                                            title="<?php echo smartyTranslate(array('s'=>'More about','mod'=>'blocksupplier'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['supplier']->value['name'];?>
">
                                        <?php }?>
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['supplier']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                                        <?php if ($_smarty_tpl->tpl_vars['display_link_supplier']->value) {?>
                                    </a>
                                    <?php }?>
                                </li>
                            <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                    </ul>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['form_list']->value) {?>
                    <form action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME'], ENT_QUOTES, 'UTF-8', true);?>
" method="get">
                        <div class="form-group selector1">
                            <select class="form-control" name="supplier_list">
                                <option value="0"><?php echo smartyTranslate(array('s'=>'All suppliers','mod'=>'blocksupplier'),$_smarty_tpl);?>
</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['suppliers']->value, 'supplier');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['supplier']->value) {
?>
                                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getsupplierLink($_smarty_tpl->tpl_vars['supplier']->value['id_supplier'],$_smarty_tpl->tpl_vars['supplier']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['supplier']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                            </select>
                        </div>
                    </form>
                <?php }?>
            <?php } else { ?>
                <p><?php echo smartyTranslate(array('s'=>'No supplier','mod'=>'blocksupplier'),$_smarty_tpl);?>
</p>
            <?php }?>
        </div>
    </div>
</section><?php }
}
