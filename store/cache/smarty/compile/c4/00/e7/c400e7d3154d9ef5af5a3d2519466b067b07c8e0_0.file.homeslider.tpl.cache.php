<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/homeslider/homeslider.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305684dba1_35407075',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c400e7d3154d9ef5af5a3d2519466b067b07c8e0' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/homeslider/homeslider.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e305684dba1_35407075 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '968751483603e305683edc1_62793779';
if ($_smarty_tpl->tpl_vars['page_name']->value == 'index') {?>
  <?php if (isset($_smarty_tpl->tpl_vars['homeslider_slides']->value)) {?>
    <div id="homepage-slider" class="col-xs-12">
      <?php if (isset($_smarty_tpl->tpl_vars['homeslider_slides']->value[0]) && isset($_smarty_tpl->tpl_vars['homeslider_slides']->value[0]['sizes'][1])) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'height', null, null);
echo $_smarty_tpl->tpl_vars['homeslider_slides']->value[0]['sizes'][1];
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
}?>
      <ul id="homeslider"<?php $_prefixVariable2=$_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'height');
if (isset($_prefixVariable2) && $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'height')) {?> style="max-height:<?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'height');?>
px;"<?php }?>>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['homeslider_slides']->value, 'slide');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
?>
          <?php if ($_smarty_tpl->tpl_vars['slide']->value['active']) {?>
            <li class="homeslider-container">
              <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
">
                <img  class="img-responsive"
                      src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)@constant('_MODULE_DIR_'))."homeslider/images/".((string)mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')));?>
"
                      <?php if (isset($_smarty_tpl->tpl_vars['slide']->value['size']) && $_smarty_tpl->tpl_vars['slide']->value['size']) {?> <?php echo $_smarty_tpl->tpl_vars['slide']->value['size'];
}?>
                      alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                      style="width: 100%; height: 100%"
                >
              </a>
              <?php if (isset($_smarty_tpl->tpl_vars['slide']->value['description']) && trim($_smarty_tpl->tpl_vars['slide']->value['description']) != '') {?>
                <div class="homeslider-wrapper hidden-xs">
                  <div class="homeslider-inner">
                  <div class="homeslider-description"><?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>
</div>
                  </div>
                </div>
              <?php }?>
            </li>
          <?php }?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

      </ul>
      <div id="homeslider-pager">
        <span><?php echo smartyTranslate(array('s'=>'More offers:','mod'=>'homeslider'),$_smarty_tpl);?>
</span>
        <span id="homeslider-pages"></span>
      </div>
    </div>
  <?php }
}
}
}
