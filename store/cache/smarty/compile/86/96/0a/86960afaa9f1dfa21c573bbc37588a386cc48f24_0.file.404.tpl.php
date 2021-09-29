<?php
/* Smarty version 3.1.31, created on 2021-09-09 18:44:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/404.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_613a8e49083444_30843193',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86960afaa9f1dfa21c573bbc37588a386cc48f24' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/404.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_613a8e49083444_30843193 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="pagenotfound jumbotron text-center">
  <?php echo smartyHook(array('h'=>'displayNotFoundTop'),$_smarty_tpl);?>

  <h2><?php echo smartyTranslate(array('s'=>'This page is not available'),$_smarty_tpl);?>
</h2>
  <p><?php echo smartyTranslate(array('s'=>'We\'re sorry, but the Web address you\'ve entered is no longer available.'),$_smarty_tpl);?>
</p>
  <p><?php echo smartyTranslate(array('s'=>'To find a product, please type its name in the field below.'),$_smarty_tpl);?>
</p>
  <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search'), ENT_QUOTES, 'UTF-8', true);?>
" method="post">
    <div>
      <label for="search_query"><?php echo smartyTranslate(array('s'=>'Search our product catalog:'),$_smarty_tpl);?>
</label>
      <div class="input-group">
        <input id="search_query" name="search_query" type="text" class="form-control">
        <span class="input-group-btn">
          <button type="submit" name="Submit" value="OK" class="btn btn-primary"><i class="icon icon-search"></i></button>
        </span>
      </div>
    </div>
  </form>
</div>
<?php echo smartyHook(array('h'=>'displayNotFoundBottom'),$_smarty_tpl);?>

<nav>
  <ul class="pager">
    <li>
      <a href="<?php if (isset($_smarty_tpl->tpl_vars['force_ssl']->value) && $_smarty_tpl->tpl_vars['force_ssl']->value) {
echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;
} else {
echo $_smarty_tpl->tpl_vars['base_dir']->value;
}?>" title="<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
">
        <?php if ($_smarty_tpl->tpl_vars['isRtl']->value) {?>&rarr;<?php } else { ?>&larr;<?php }?> <?php echo smartyTranslate(array('s'=>'Home page'),$_smarty_tpl);?>

      </a>
    </li>
  </ul>
</nav>
<?php }
}
