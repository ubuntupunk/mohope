<?php

//print_r($_SERVER);die();

$sitepad['db_name'] = 'sexthera_spad862';
$sitepad['db_user'] = 'sexthera_spad862';
$sitepad['db_pass'] = '@cOkx0-25.';
$sitepad['db_host'] = 'localhost';
$sitepad['db_table_prefix'] = 'Ww0gUZm_';
$sitepad['charset'] = 'utf8mb4';
$sitepad['collate'] = 'utf8mb4_unicode_ci';
$sitepad['serving_url'] = 'mohope.web.za/test';// URL without protocol but with directory as well
$sitepad['url'] = 'https://mohope.web.za/test';
$sitepad['relativeurl'] = '/test';
$sitepad['.sitepad'] = '/home/sexthera';
$sitepad['sitepad_plugin_path'] = '/usr/local/sitepad';
$sitepad['editor_path'] = '/usr/local/sitepad/editor';
$sitepad['path'] = dirname(__FILE__);
$sitepad['AUTH_KEY'] = 'ccSmqNUzeOq3WPPoNLas3nzVphy4K60ozlyrGjeq3vmscMCoTSgpSBSzsqGIRq6G';
$sitepad['SECURE_AUTH_KEY'] = 'torTmSsFSwOCm4g5PrtRbaig9JSuIjJenM47R3Ll8QqITyUQUCuKoVGpiYIpsWlA';
$sitepad['LOGGED_IN_KEY'] = 'IGxw5EQ8kTLgHru9uMtJ9r5uuYClAnFB6DtSGD5ScKWQM6E5jmFoR4wWijisCuV3';
$sitepad['NONCE_KEY'] = 'KFYtH7ulBFbpOm1vErnVO2De9AhfvDey9cfnqHwvBsk2SDO3TS15N0hhPMtMfQpM';
$sitepad['AUTH_SALT'] = 'mcnVJ5UXD3T6HoZmDDLhiKD8GNzvMeVoctflsi6MZwAvJ27v0EpbaDk9G7VfqMAw';
$sitepad['SECURE_AUTH_SALT'] = 'T9knn8xdmARTi4LiB00Qx5oTqQBIOfVZoJ7hrxc6wpbleDQOzq895MQGbToQJdfz';
$sitepad['LOGGED_IN_SALT'] = 's19BSPtKKMbbTabHIpxY3LKj2QnU1kakPB1sH2dkgicbnXNfE1snnmv1m0BEjm1k';
$sitepad['NONCE_SALT'] = 'FJ0MxgyXn7H3gIvGVXyMICvJk0xM0pd4vWnIgvy9DUXVpDMNcMTHyeufagZQVVnQ';

if(!include_once($sitepad['editor_path'].'/site-inc/bootstrap.php')){
	die('Could not include the bootstrap.php. One of the reasons could be open_basedir restriction !');
}

