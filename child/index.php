<?php

//print_r($_SERVER);die();

$sitepad['db_name'] = 'sexthera_spad207';
$sitepad['db_user'] = 'sexthera_spad207';
$sitepad['db_pass'] = 'b!(6[p8uSg';
$sitepad['db_host'] = 'localhost';
$sitepad['db_table_prefix'] = 'NMedtB1_';
$sitepad['charset'] = 'utf8mb4';
$sitepad['collate'] = 'utf8mb4_unicode_ci';
$sitepad['serving_url'] = 'mohope.web.za/child';// URL without protocol but with directory as well
$sitepad['url'] = 'https://mohope.web.za/child';
$sitepad['relativeurl'] = '/child';
$sitepad['.sitepad'] = '/home/sexthera';
$sitepad['sitepad_plugin_path'] = '/usr/local/sitepad';
$sitepad['editor_path'] = '/usr/local/sitepad/editor';
$sitepad['path'] = dirname(__FILE__);
$sitepad['AUTH_KEY'] = 'BwHCXUKVAgLfQxf8NQmcS3qmrdYmvfofwox7O449eMTbi3U0C1lhJmUAmFwEqNUZ';
$sitepad['SECURE_AUTH_KEY'] = 'UzcbT80enQWjewdBWnreKZM3MYgqEB7WmcijTNtOMWiFKQYqOK4clbp1ylhh3Tg5';
$sitepad['LOGGED_IN_KEY'] = 'KGaWOnG86PNaANKJSuoqmFx82lr4HjI0ne0F7Dqkab8KaJGkHVE65heL6AKcPZXY';
$sitepad['NONCE_KEY'] = 'UIdDYdCN0rtNSM2NVZvwGzMiVdudRlix8h3bEG0idExulFscZqDfHpWGQyiI7q16';
$sitepad['AUTH_SALT'] = '6Z9bslbce5RCEGjnVsQD9O0DGEXmdgS90uUOCoYiYUPHs4fR8pHqkk5xTWcIYxGe';
$sitepad['SECURE_AUTH_SALT'] = 'cTPnJ5g8grqKtH7fF6LiV1vFvzYFAroTpztgs2nVw3cwSweoUmhohdclTPNcWWNx';
$sitepad['LOGGED_IN_SALT'] = 'P9dhf8Nv93kAHmYHlQPtC8iWe0FXpzfYWiuZX4zKA67kujZAjQgAn7DOqHr42HXh';
$sitepad['NONCE_SALT'] = 'HPtaysVtxNopwLU3NX7eW6Y8QfPQuSd87NgEv5stmj4tl4vcUMmSPrMj2yxJF1LB';

if(!include_once($sitepad['editor_path'].'/site-inc/bootstrap.php')){
	die('Could not include the bootstrap.php. One of the reasons could be open_basedir restriction !');
}

