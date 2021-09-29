<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:30:17
  from "/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/helpers/modules_list/modal.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e2fd9755d07_13936176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6140151bd85ce8ecd65fe91c35a94798e09612be' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/helpers/modules_list/modal.tpl',
      1 => 1564078910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e2fd9755d07_13936176 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo smartyTranslate(array('s'=>'Recommended Modules and Services'),$_smarty_tpl);?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab_modal" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div>
<?php }
}
