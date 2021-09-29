<?php
/* Smarty version 3.1.31, created on 2021-03-02 07:47:37
  from "/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocksearch/blocksearch-top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_603e33e933ab03_25450399',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7842df2cce9831f2f9df8bf08298ae8c658cd2d6' => 
    array (
      0 => '/home/sexthera/public_html/mohope.web.za/store/themes/niara/modules/blocksearch/blocksearch-top.tpl',
      1 => 1563910602,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 31536000,
),true)) {
function content_603e33e933ab03_25450399 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="search_block_top" class="col-sm-4 col-md-5" role="search">
  <form id="searchbox" method="get" action="//mohope.web.za/store/search" >
    <input type="hidden" name="controller" value="search">
    <input type="hidden" name="orderby" value="position">
    <input type="hidden" name="orderway" value="desc">
    <div class="input-group input-group-lg">
      <input class="form-control" type="search" id="search_query_top" name="search_query" placeholder="Search" value="" required aria-label="Search our site">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="submit" name="submit_search" title="Search"><i class="icon icon-search"></i></button>
      </span>
    </div>
  </form>
</div>
<?php }
}
