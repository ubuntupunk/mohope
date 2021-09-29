<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:32:22
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocksocial/blocksocial.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e305672ccc3_14645023',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe688ec29e608e50976da26fdce5f37e3d2d28e8' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocksocial/blocksocial.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e305672ccc3_14645023 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '328070662603e305670f786_77293714';
?>
<section id="blocksocial" class="col-xs-12">
    <h2 class="title_block main-title-column social-header"><?php echo smartyTranslate(array('s'=>'Follow us','mod'=>'blocksocial'),$_smarty_tpl);?>
</h2>

    <?php if (!empty($_smarty_tpl->tpl_vars['facebook_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['facebook_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Facebook','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-facebook icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['twitter_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['twitter_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Twitter','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-twitter icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['rss_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rss_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'RSS','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank" rel="noopener">
            <i class="icon icon-rss icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['youtube_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['youtube_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Youtube','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-youtube icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['pinterest_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pinterest_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Pinterest','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-pinterest icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['vimeo_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vimeo_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Vimeo','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-vimeo icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['instagram_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['instagram_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Instagram','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-instagram icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['vk_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vk_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'VK','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank" rel="noopener">
            <i class="icon icon-vk icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['linkedin_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['linkedin_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Linkedin','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-linkedin icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['wordpress_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wordpress_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'WordPress','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-wordpress icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['amazon_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['amazon_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Amazon','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-amazon icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['tumblr_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tumblr_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Tumblr','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-tumblr icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['snapchat_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['snapchat_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Snapchat','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-snapchat icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['reddit_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['reddit_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Reddit','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-reddit icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['yelp_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['yelp_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Yelp','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank" rel="noopener">
            <i class="icon icon-yelp icon-2x icon-fw"></i>
        </a>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['medium_url']->value)) {?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['medium_url']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Medium','mod'=>'blocksocial'),$_smarty_tpl);?>
" target="_blank"
           rel="noopener">
            <i class="icon icon-medium icon-2x icon-fw"></i>
        </a>
    <?php }?>
</section>
<?php }
}
