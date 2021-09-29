<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocknewsletter/blocknewsletter.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3056708126_82190634',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3ce978e2bb790b5d19da803f1b38682085c7301' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocknewsletter/blocknewsletter.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e3056708126_82190634 (Smarty_Internal_Template $_smarty_tpl) {
?>
<section id="blocknewsletter" class="col-xs-12 col-sm-3">
  <h2 class="footer-title section-footer-title"><?php echo smartyTranslate(array('s'=>'Newsletter','mod'=>'blocknewsletter'),$_smarty_tpl);?>
</h2>
  <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',null,null,null,false,null,true), ENT_QUOTES, 'UTF-8', true);?>
" method="post">
    <div class="form-group<?php if (isset($_smarty_tpl->tpl_vars['msg']->value) && $_smarty_tpl->tpl_vars['msg']->value) {?> <?php if ($_smarty_tpl->tpl_vars['nw_error']->value) {?>form-error<?php } else { ?>form-ok<?php }
}?>" >
      <div class="input-group">
        <input class="form-control" id="newsletter-input" type="email" name="email" size="18" value="<?php if (isset($_smarty_tpl->tpl_vars['msg']->value) && $_smarty_tpl->tpl_vars['msg']->value) {
echo $_smarty_tpl->tpl_vars['msg']->value;
} elseif (isset($_smarty_tpl->tpl_vars['value']->value) && $_smarty_tpl->tpl_vars['value']->value) {
echo $_smarty_tpl->tpl_vars['value']->value;
} else {
echo smartyTranslate(array('s'=>'Enter your e-mail','mod'=>'blocknewsletter'),$_smarty_tpl);
}?>" aria-label="Email Address">
        <span class="input-group-btn">
          <button type="submit" name="submitNewsletter" class="btn btn-primary" aria-label="Sign up">
            <i class="icon icon-envelope-alt"></i>
          </button>
        </span>
      </div>
      <input type="hidden" name="action" value="0" />
    </div>
  </form>
  <?php echo smartyHook(array('h'=>"displayBlockNewsletterBottom",'from'=>'blocknewsletter'),$_smarty_tpl);?>

</section>

<?php if (isset($_smarty_tpl->tpl_vars['msg']->value) && $_smarty_tpl->tpl_vars['msg']->value) {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('msg_newsl'=>addcslashes($_smarty_tpl->tpl_vars['msg']->value,'\'')),$_smarty_tpl);
}
if (isset($_smarty_tpl->tpl_vars['nw_error']->value)) {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('nw_error'=>$_smarty_tpl->tpl_vars['nw_error']->value),$_smarty_tpl);
}
$_block_plugin9 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin9, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'placeholder_blocknewsletter'));
$_block_repeat=true;
echo $_block_plugin9->addJsDefL(array('name'=>'placeholder_blocknewsletter'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'Enter your e-mail','mod'=>'blocknewsletter','js'=>1),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin9->addJsDefL(array('name'=>'placeholder_blocknewsletter'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
if (isset($_smarty_tpl->tpl_vars['msg']->value) && $_smarty_tpl->tpl_vars['msg']->value) {
$_block_plugin10 = isset($_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]) ? $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0] : null;
if (!is_callable(array($_block_plugin10, 'addJsDefL'))) {
throw new SmartyException('block tag \'addJsDefL\' not callable or registered');
}
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('addJsDefL', array('name'=>'alert_blocknewsletter'));
$_block_repeat=true;
echo $_block_plugin10->addJsDefL(array('name'=>'alert_blocknewsletter'), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();
echo smartyTranslate(array('s'=>'Newsletter : %1$s','sprintf'=>$_smarty_tpl->tpl_vars['msg']->value,'js'=>1,'mod'=>"blocknewsletter"),$_smarty_tpl);
$_block_repeat=false;
echo $_block_plugin10->addJsDefL(array('name'=>'alert_blocknewsletter'), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}
}
}
