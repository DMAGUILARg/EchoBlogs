<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Landing';
$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';
$route['auth/do_login'] = 'Auth/do_login'; 
$route['articulos/filtrar_por_categoria/(:any)'] = 'articulos/filtrar_por_categoria/$1';
$route['blog'] = 'Articulos/blog';
$route['perfil'] = 'Profile/perfil';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;