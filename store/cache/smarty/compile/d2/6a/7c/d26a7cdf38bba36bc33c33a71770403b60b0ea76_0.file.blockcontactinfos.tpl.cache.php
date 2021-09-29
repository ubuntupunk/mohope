<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcontactinfos/blockcontactinfos.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e30567ba2e5_12888852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd26a7cdf38bba36bc33c33a71770403b60b0ea76' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blockcontactinfos/blockcontactinfos.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e30567ba2e5_12888852 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_function_mailto')) require_once '/home/sexthera/public_html/mohope.web.za/store/vendor/smarty/smarty/libs/plugins/function.mailto.php';
$_smarty_tpl->compiled->nocache_hash = '1094961336603e30567b0353_37320684';
?>
<section id="blockcontactinfos" class="col-xs-12 col-sm-3">
  <h2 class="footer-title section-title-footer"><?php echo smartyTranslate(array('s'=>'Store Information','mod'=>'blockcontactinfos'),$_smarty_tpl);?>
</h2>
  <address>
    <ul class="list-unstyled">
      <?php if (!empty($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value)) {?>
        <li>
          <b><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_company']->value, ENT_QUOTES, 'UTF-8', true);?>
</b>
        </li>
      <?php }?>
      <?php if (!empty($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value)) {?>
        <li>
          <?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_address']->value, ENT_QUOTES, 'UTF-8', true));?>

        </li>
      <?php }?>
      <?php if (!empty($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value)) {?>
        <li>
          <i class="icon icon-phone"></i>
          <a href="tel:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_phone']->value, ENT_QUOTES, 'UTF-8', true);?>
</a>
        </li>
      <?php }?>
      <?php if (!empty($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value)) {?>
        <li>
          <i class="icon icon-envelope-alt"></i>
          <?php echo smarty_function_mailto(array('address'=>htmlspecialchars($_smarty_tpl->tpl_vars['blockcontactinfos_email']->value, ENT_QUOTES, 'UTF-8', true),'encode'=>"hex"),$_smarty_tpl);?>

        </li>
      <?php }?>
    </ul>
  </address>
</section>
<?php }
}
