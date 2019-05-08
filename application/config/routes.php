<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Login Routes
$route['double/saveValueForecastingDouble'] = 'double/saveValueForecastingDouble';
$route['double/clearData'] = 'double/clearData';
$route['double/processForecastingEksponentialDouble'] = 'double/processForecastingEksponentialDouble';
$route['double'] = 'double/index';


$route['login'] = 'login/index';
$route['logout'] = 'login/logout';

$route['default_controller'] = 'forecasting';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

