<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocktopmenu/blocktopmenu.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305650bf21_41731963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb150d028be9c4deece13e65121fb4578faf8e1e' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocktopmenu/blocktopmenu.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e305650bf21_41731963 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1605809061603e3056506437_08152522';
if ($_smarty_tpl->tpl_vars['MENU']->value != '') {?>
    <nav>
        <div id="block_top_menu" class="sf-contener clearfix col-lg-12">
            <div class="cat-title"><?php echo smartyTranslate(array('s'=>'Menu','mod'=>'blocktopmenu'),$_smarty_tpl);?>
</div>
            <ul class="sf-menu clearfix menu-content">
                <?php echo $_smarty_tpl->tpl_vars['MENU']->value;?>

                <?php if ($_smarty_tpl->tpl_vars['MENU_SEARCH']->value) {?>
                    <li class="sf-search noBack" style="float:right">
                        <form id="searchbox" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'), ENT_QUOTES, 'UTF-8', true);?>
" method="get">
                            <p>
                                <input type="hidden" name="controller" value="search">
                                <input type="hidden" value="position" name="orderby">
                                <input type="hidden" value="desc" name="orderway">
                                <input type="text" name="search_query"
                                       value="<?php if (isset($_GET['search_query'])) {
echo htmlspecialchars($_GET['search_query'], ENT_QUOTES, 'UTF-8', true);
}?>">
                            </p>
                        </form>
                    </li>
                <?php }?>
            </ul>
        </div>
    </nav>
<?php }
}
}
