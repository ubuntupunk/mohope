<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:30:17
  from "/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/controllers/login/content.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e2fd97074c1_88371867',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f77fc67222a06c4532ac0ab3c216af48e2ffa545' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/admin123/themes/default/template/controllers/login/content.tpl',
      1 => 1564078910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e2fd97074c1_88371867 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/sexthera/public_html/mohope.web.za/store/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
?>

<div id="login-panel">
	<div id="login-header">
		<h1 class="text-center">
			<img id="logo" src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
thirty-bees@2x.png" width="155px" height="39px" alt="thirty bees" />
		</h1>
		<div class="text-center"><?php echo $_smarty_tpl->tpl_vars['ps_version']->value;?>
</div>
		<div id="error" class="hide alert alert-danger">
		<?php if (isset($_smarty_tpl->tpl_vars['errors']->value)) {?>
			<h4>
				<?php if (isset($_smarty_tpl->tpl_vars['nbErrors']->value) && $_smarty_tpl->tpl_vars['nbErrors']->value > 1) {?>
					<?php echo smartyTranslate(array('s'=>'There are %d errors.','sprintf'=>$_smarty_tpl->tpl_vars['nbErrors']->value),$_smarty_tpl);?>

				<?php } else { ?>
					<?php echo smartyTranslate(array('s'=>'There is %d error.','sprintf'=>$_smarty_tpl->tpl_vars['nbErrors']->value),$_smarty_tpl);?>

				<?php }?>
			</h4>
			<ol>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
				<li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

			</ol>
		<?php }?>
		</div>

		<?php if (isset($_smarty_tpl->tpl_vars['warningSslMessage']->value)) {?>
		<div class="alert alert-warning"><?php echo $_smarty_tpl->tpl_vars['warningSslMessage']->value;?>
</div>
		<?php }?>
	</div>
	<div class="flip-container">
		<div class="flipper">
			<div class="front panel">
				<h4 id="shop_name"><?php echo $_smarty_tpl->tpl_vars['shop_name']->value;?>
</h4>
				<?php if (!isset($_smarty_tpl->tpl_vars['wrong_folder_name']->value) && !isset($_smarty_tpl->tpl_vars['wrong_install_name']->value)) {?>
				<form action="#" id="login_form" method="post">
					<input type="hidden" name="redirect" id="redirect" value="<?php echo $_smarty_tpl->tpl_vars['redirect']->value;?>
"/>
					<div class="form-group">
						<label class="control-label" for="email"><?php echo smartyTranslate(array('s'=>'Email address'),$_smarty_tpl);?>
</label>
						<input name="email" type="email" id="email" class="form-control" value="<?php if (isset($_smarty_tpl->tpl_vars['email']->value)) {
echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['idnToUtf8'][0][0]->convertEmailFromIdn($_smarty_tpl->tpl_vars['email']->value), ENT_QUOTES, 'UTF-8', true);
}?>" autofocus="autofocus" tabindex="1" placeholder="&#xf0e0 test@example.com" />
					</div>
					<div class="form-group">
						<label class="control-label" for="passwd">
							<?php echo smartyTranslate(array('s'=>'Password'),$_smarty_tpl);?>

						</label>
						<input name="passwd" type="password" id="passwd" class="form-control" value="<?php if (isset($_smarty_tpl->tpl_vars['password']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['password']->value, ENT_QUOTES, 'UTF-8', true);
}?>" tabindex="2" placeholder="&#xf084 <?php echo smartyTranslate(array('s'=>'Password'),$_smarty_tpl);?>
" />
					</div>
					<div class="form-group row-padding-top">
						<button name="submitLogin" type="submit" tabindex="4" class="btn btn-primary btn-lg btn-block ladda-button" data-style="slide-up" data-spinner-color="white" >
							<span class="ladda-label">
								<?php echo smartyTranslate(array('s'=>'Log in'),$_smarty_tpl);?>

							</span>
						</button>
					</div>
					<div class="form-group">
						<div id="remind-me" class="checkbox pull-left">
							<label for="stay_logged_in">
								<input name="stay_logged_in" type="checkbox" id="stay_logged_in" value="1"	tabindex="3" checked="checked"/>
								<?php echo smartyTranslate(array('s'=>'Stay logged in'),$_smarty_tpl);?>

							</label>
						</div>
						<a href="#" class="show-forgot-password pull-right" >
							<?php echo smartyTranslate(array('s'=>'I forgot my password'),$_smarty_tpl);?>

						</a>
					</div>
				</form>
			</div>

			<div class="back panel">
				<form action="#" id="forgot_password_form" method="post">
					<div class="alert alert-info">
						<h4><?php echo smartyTranslate(array('s'=>'Forgot your password?'),$_smarty_tpl);?>
</h4>
						<p><?php echo smartyTranslate(array('s'=>'In order to receive your access code by email, please enter the address you provided during the registration process.'),$_smarty_tpl);?>
</p>
					</div>
					<div class="form-group">
						<label class="control-label" for="email_forgot">
							<?php echo smartyTranslate(array('s'=>'Email'),$_smarty_tpl);?>

						</label>
						<input type="text" name="email_forgot" id="email_forgot" class="form-control" autofocus="autofocus" tabindex="5" placeholder="&#xf0e0 test@example.com" />
					</div>
					<div class="panel-footer">
						<button type="button" href="#" class="btn btn-default show-login-form" tabindex="7">
							<i class="icon-caret-left"></i>
							<?php echo smartyTranslate(array('s'=>'Back to login'),$_smarty_tpl);?>

						</button>
						<button class="btn btn-default pull-right" name="submitLogin" type="submit" tabindex="6">
							<i class="icon-ok text-success"></i>
							<?php echo smartyTranslate(array('s'=>'Send'),$_smarty_tpl);?>

						</button>
					</div>
				</form>
			</div>
		</div>
		<?php } else { ?>
		<div class="alert alert-danger">
			<p><?php echo smartyTranslate(array('s'=>'For security reasons, you cannot connect to the back office until you have:'),$_smarty_tpl);?>
</p>
			<ul>
				<?php if (isset($_smarty_tpl->tpl_vars['wrong_install_name']->value) && $_smarty_tpl->tpl_vars['wrong_install_name']->value == true) {?>
					<li><?php echo smartyTranslate(array('s'=>'deleted the /install folder'),$_smarty_tpl);?>
</li>
				<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['wrong_folder_name']->value) && $_smarty_tpl->tpl_vars['wrong_folder_name']->value == true) {?>
					<li><?php echo smartyTranslate(array('s'=>'renamed the /admin folder (e.g. %s)','sprintf'=>$_smarty_tpl->tpl_vars['randomNb']->value),$_smarty_tpl);?>
</li>
				<?php }?>
			</ul>
			<p>
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['adminUrl']->value, ENT_QUOTES, 'UTF-8', true);?>
">
					<?php echo smartyTranslate(array('s'=>'Please then access this page by the new URL (e.g. %s)','sprintf'=>$_smarty_tpl->tpl_vars['adminUrl']->value),$_smarty_tpl);?>

				</a>
			</p>
		</div>
		<?php }?>
	</div>
	<?php echo smartyHook(array('h'=>"displayAdminLogin"),$_smarty_tpl);?>

	<div id="login-footer">
		<p class="text-center text-muted">
			<a href="http://www.thirtybees.com/" onclick="return !window.open(this.href);">
				&copy; thirty bees&#8482; 2007-<?php echo smarty_modifier_date_format(time(),"%Y");?>
 - All rights reserved
			</a>
		</p>
		<p class="text-center">
			<a class="link-social link-twitter _blank" href="https://twitter.com/thethirtybees" title="Twitter">
				<i class="icon-twitter"></i>
			</a>
			<a class="link-social link-facebook _blank" href="https://www.facebook.com/thirtybees" title="Facebook">
				<i class="icon-facebook"></i>
			</a>
			<a class="link-social link-github _blank" href="https://github.com/thirtybees" title="Github">
				<i class="icon-github"></i>
			</a>
			<a class="link-social link-google _blank" href="https://plus.google.com/+thirtybees/" title="Google">
				<i class="icon-google-plus"></i>
			</a>
			<a class="link-social link-reddit _blank" href="https://www.reddit.com/r/thirtybees/" title="Reddit">
				<i class="icon-reddit"></i>
			</a>
		</p>
	</div>
</div>
<?php }
}
