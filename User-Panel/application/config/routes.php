<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Start';
$route['login'] = 'Login';
$route['register'] = 'Register';
$route['register/new'] = 'Register/usernew';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['profile'] = 'Profile';
$route['chageProfile'] = 'Profile/change';
$route['chagePassword'] = 'Profile/changePassword';
$route['account'] = 'Account';
$route['paypal'] = 'PayPal';
$route['paypalsuccess'] = 'PayPal/success';
$route['paypalcancel'] = 'PayPal/cancel';
$route['paypalfree'] = 'PayPal/free';
$route['search'] = 'Search';
$route['search/result'] = 'Search/getInfo';
$route['search/detail/id'] = 'Search/detail/$id';
$route['mass'] = 'Bulk';
$route['mass/result'] = 'Bulk/getInfo';
$route['tophashtags'] = 'Top';
