<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305685bd75_58709741',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4bc3035332b7b0c75b4ef944696be950d165d933' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/footer.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e305685bd75_58709741 (Smarty_Internal_Template $_smarty_tpl) {
if (!isset($_smarty_tpl->tpl_vars['content_only']->value) || !$_smarty_tpl->tpl_vars['content_only']->value) {?>
      </main>
    <?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value) && !empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
      <aside id="right_column" class="col-xs-12 col-sm-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
" role="navigation complementary"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</aside>
    <?php }?>
    </div>
  </div>

  <footer id="footer">

    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_FOOTER']->value)) {?>
      <div class="container">
        <div class="row"><?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>
</div>
      </div>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['ctheme']->value['footer']['copyright']['display'])) {?>
      <div id="copyright-footer" role="contentinfo">
        <?php echo $_smarty_tpl->tpl_vars['ctheme']->value['footer']['copyright']['html'];?>

      </div>
    <?php }?>

  </footer>

<?php }
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

</body>
</html>
<?php }
}
