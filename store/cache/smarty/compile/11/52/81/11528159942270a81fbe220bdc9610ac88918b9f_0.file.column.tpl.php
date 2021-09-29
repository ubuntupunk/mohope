<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:40:25
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblogrecentposts/views/templates/hooks/column.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e3239e1a235_90685612',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11528159942270a81fbe220bdc9610ac88918b9f' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/beesblogrecentposts/views/templates/hooks/column.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_603e3239e1a235_90685612 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/sexthera/public_html/mohope.web.za/store/vendor/smarty/smarty/libs/plugins/modifier.date_format.php';
if (!empty($_smarty_tpl->tpl_vars['beesblogRecentPostsPosts']->value)) {?>

    <div id="beesblog_column" class="block">
        <h4 class="title_block">
            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['beesblogRecentPostsBlogUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Recent posts','mod'=>'beesblogrecentposts'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Recent posts','mod'=>'beesblogrecentposts'),$_smarty_tpl);?>
</a>
        </h4>
        <div class="block_content">
            <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['beesblogRecentPostsPosts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
                    <li class="clearfix">
                        <div class="beesblogrecentposts-content">
                            <h5>
                                <a class="beesblogrecentposts-title" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->link, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->title, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                                    <?php echo mb_convert_encoding(htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['post']->value->title,'20'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                </a>
                            </h5>
                            <span>
                                <i class="icon icon-time"></i> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value->published);?>

                                <i class="icon icon-eye"></i> <?php echo intval($_smarty_tpl->tpl_vars['post']->value->viewed);?>

                            </span>
                        </div>
                    </li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

            </ul>
            <br />
            <div>
                <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['beesblogRecentPostsBlogUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Bees blog','mod'=>'beesblogrecentposts'),$_smarty_tpl);?>
" class="btn btn-primary"><span><?php echo smartyTranslate(array('s'=>'All posts','mod'=>'beesblogrecentposts'),$_smarty_tpl);?>
</span></a>
            </div>
        </div>
    </div>
<?php }
}
}
