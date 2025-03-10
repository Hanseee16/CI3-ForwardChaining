<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'auth/not_found';
$route['translate_uri_dashes'] = FALSE;

// HOME
$route['/'] = 'home';

// AUTH
$route['login'] = 'auth/login';
$route['registrasi'] = 'auth/registrasi';
$route['logout'] = 'auth/logout';

// ADMIN
$route['admin/dashboard'] = 'admin';
$route['tambah_gejala'] = 'admin/tambah_gejala';
$route['edit_gejala/(:any)'] = 'admin/edit_gejala/$1';
$route['hapus_gejala/(:any)'] = 'admin/hapus_gejala/$1';
$route['tambah_penyakit'] = 'admin/tambah_penyakit';
$route['edit_penyakit/(:any)'] = 'admin/edit_penyakit/$1';
$route['hapus_penyakit/(:any)'] = 'admin/hapus_penyakit/$1';
$route['admin/tambah_relasi/(:any)'] = 'admin/v_tambah_relasi/$1';
$route['tambah_relasi/(:any)'] = 'admin/tambah_relasi/$1';
$route['admin/edit_relasi/(:any)'] = 'admin/v_edit_relasi/$1';
$route['edit_relasi/(:any)'] = 'admin/edit_relasi/$1';

// PAKAR
$route['pakar/dashboard'] = 'pakar';
$route['pakar/tambah_relasi/(:any)'] = 'pakar/v_tambah_relasi/$1';
$route['pakar/edit_relasi/(:any)'] = 'admin/v_edit_relasi/$1';

// USER
$route['user/dashboard'] = 'user';
$route['tambah_konsultasi'] = 'user/tambah_konsultasi';
