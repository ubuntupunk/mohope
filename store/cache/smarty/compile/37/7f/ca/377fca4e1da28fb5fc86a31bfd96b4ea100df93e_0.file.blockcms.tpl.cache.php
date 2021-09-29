<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcms/blockcms.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305676d2f4_54735654',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '377fca4e1da28fb5fc86a31bfd96b4ea100df93e' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcms/blockcms.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e305676d2f4_54735654 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '809905958603e30567484c8_82202757';
if ($_smarty_tpl->tpl_vars['block']->value == 1) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cms_titles']->value, 'cms_title');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cms_title']->value) {
?>
        <section class="blockcms-block blockcms-block-col block">
            <h2 class="title_block section-title-column">
                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_title']->value['category_link'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <?php if (!empty($_smarty_tpl->tpl_vars['cms_title']->value['name'])) {
echo $_smarty_tpl->tpl_vars['cms_title']->value['name'];
} else {
echo $_smarty_tpl->tpl_vars['cms_title']->value['category_name'];
}?>
                </a>
            </h2>
            <div class="block_content list-block">
                <nav>
                    <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cms_title']->value['categories'], 'cms_page');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cms_page']->value) {
?>
                            <?php if (isset($_smarty_tpl->tpl_vars['cms_page']->value['link'])) {?>
                                <li>

                                    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                                       title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                                    </a>

                                </li>
                            <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cms_title']->value['cms'], 'cms_page');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cms_page']->value) {
?>
                            <?php if (isset($_smarty_tpl->tpl_vars['cms_page']->value['link'])) {?>
                                <li>

                                    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                                       title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>

                                    </a>

                                </li>
                            <?php }?>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                        <?php if ($_smarty_tpl->tpl_vars['cms_title']->value['display_store']) {?>
                            <li>

                                <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('stores'), ENT_QUOTES, 'UTF-8', true);?>
"
                                   title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
">
                                    <?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>

                                </a>

                            </li>
                        <?php }?>
                    </ul>
                </nav>
            </div>
        </section>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

<?php } else { ?>
    <section id="blockcms-footer" class="blockcms-block col-xs-12 col-sm-3">
        <h2 class="footer-title title_block section-title-footer"><?php echo smartyTranslate(array('s'=>'Information','mod'=>'blockcms'),$_smarty_tpl);?>
</h2>
        <nav>
            <ul class="list-unstyled">
                <?php if (isset($_smarty_tpl->tpl_vars['show_price_drop']->value) && $_smarty_tpl->tpl_vars['show_price_drop']->value && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                    <li>

                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('prices-drop'), ENT_QUOTES, 'UTF-8', true);?>
"
                           title="<?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockcms'),$_smarty_tpl);?>
">
                            <?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockcms'),$_smarty_tpl);?>

                        </a>

                    </li>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['show_new_products']->value) && $_smarty_tpl->tpl_vars['show_new_products']->value) {?>
                    <li>

                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('new-products'), ENT_QUOTES, 'UTF-8', true);?>
"
                           title="<?php echo smartyTranslate(array('s'=>'New products','mod'=>'blockcms'),$_smarty_tpl);?>
">
                            <?php echo smartyTranslate(array('s'=>'New products','mod'=>'blockcms'),$_smarty_tpl);?>

                        </a>

                    </li>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['show_best_sales']->value) && $_smarty_tpl->tpl_vars['show_best_sales']->value && !$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                    <li>

                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('best-sales'), ENT_QUOTES, 'UTF-8', true);?>
"
                           title="<?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockcms'),$_smarty_tpl);?>
">
                            <?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockcms'),$_smarty_tpl);?>

                        </a>

                    </li>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['display_stores_footer']->value) && $_smarty_tpl->tpl_vars['display_stores_footer']->value) {?>
                    <li>

                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('stores'), ENT_QUOTES, 'UTF-8', true);?>
"
                           title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
">
                            <?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>

                        </a>

                    </li>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['show_contact']->value) && $_smarty_tpl->tpl_vars['show_contact']->value) {?>
                    <li>

                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['contact_url']->value,true), ENT_QUOTES, 'UTF-8', true);?>
"
                           title="<?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcms'),$_smarty_tpl);?>
">
                            <?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcms'),$_smarty_tpl);?>

                        </a>

                    </li>
                <?php }?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cmslinks']->value, 'cmslink');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cmslink']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'] != '') {?>
                        <li>

                            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cmslink']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
"
                               title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
">
                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>

                            </a>

                        </li>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                <?php if (isset($_smarty_tpl->tpl_vars['show_sitemap']->value) && $_smarty_tpl->tpl_vars['show_sitemap']->value) {?>
                    <li>

                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8', true);?>
"
                           title="<?php echo smartyTranslate(array('s'=>'Sitemap','mod'=>'blockcms'),$_smarty_tpl);?>
">
                            <?php echo smartyTranslate(array('s'=>'Sitemap','mod'=>'blockcms'),$_smarty_tpl);?>

                        </a>

                    </li>
                <?php }?>
            </ul>
        </nav>
        <?php if (!empty($_smarty_tpl->tpl_vars['footer_text']->value)) {?>
            <p><?php echo $_smarty_tpl->tpl_vars['footer_text']->value;?>
</p>
        <?php }?>
    </section>
<?php }
}
}
