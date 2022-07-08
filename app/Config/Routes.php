<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/*route group*/
$routes->get('/login', 'Auth::index', ['as' => 'login']);
$routes->post('/login', 'Auth::login');
$routes->post('/logout', 'Auth::logout', ['as' => 'logout']);
$routes->get('/', 'Home::index');

$routes->group('superadmin', static function ($routes) {
    $routes->group('auth', ['namespace' => 'App\Controllers\SuperAdmin'], static function ($routes) {
        $routes->get('/', 'Auth::index');
        $routes->get('login', 'Auth::index', ['as' => 'superadmin.auth.login']);
        $routes->post('login', 'Auth::login');
        $routes->post('logout', 'Auth::logout', ['as' => 'superadmin.auth.logout']);
    });
    $routes->group('dashboard', ['namespace' => 'App\Controllers\SuperAdmin'], static function ($routes) {
        $routes->get('/', 'Dashboard::index', ['as' => 'superadmin.dashboard']);
    });
    $routes->group('arsip', ['namespace' => 'App\Controllers\SuperAdmin'], static function ($routes) {
        $routes->get('/', 'Arsip::index', ['as' => 'superadmin.arsip']);
        $routes->get('ajaxList', 'Arsip::ajaxList', ['as' => 'superadmin.arsip.ajaxList']);
        $routes->post('ajaxSave', 'Arsip::ajaxSave', ['as' => 'superadmin.arsip.ajaxSave']);
        $routes->get('ajaxEdit/(:segment)', 'Arsip::ajaxEdit/$1', ['as' => 'superadmin.arsip.ajaxEdit']);
        $routes->post('ajaxUpdate', 'Arsip::ajaxUpdate', ['as' => 'superadmin.arsip.ajaxUpdate']);
        $routes->delete('ajaxDelete/(:segment)', 'Arsip::ajaxDelete/$1', ['as' => 'superadmin.arsip.ajaxDelete']);
        $routes->put('ajaxStatus/(:segment)', 'Arsip::ajaxStatus/$1', ['as' => 'superadmin.arsip.ajaxStatus']);
        $routes->get('view/(:segment)', 'Arsip::view/$1', ['as' => 'superadmin.arsip.view']);
    });
    $routes->group('departemen', ['namespace' => 'App\Controllers\SuperAdmin'], static function ($routes) {
        $routes->get('/', 'Departemen::index', ['as' => 'superadmin.departemen']);
        $routes->get('ajaxList', 'Departemen::ajaxList', ['as' => 'superadmin.departemen.ajaxList']);
        $routes->post('ajaxSave', 'Departemen::ajaxSave', ['as' => 'superadmin.departemen.ajaxSave']);
        $routes->get('ajaxEdit/(:segment)', 'Departemen::ajaxEdit/$1', ['as' => 'superadmin.departemen.ajaxEdit']);
        $routes->post('ajaxUpdate', 'Departemen::ajaxUpdate', ['as' => 'superadmin.departemen.ajaxUpdate']);
        $routes->delete('ajaxDelete/(:segment)', 'Departemen::ajaxDelete/$1', ['as' => 'superadmin.departemen.ajaxDelete']);
        $routes->put('ajaxStatus/(:segment)', 'Departemen::ajaxStatus/$1', ['as' => 'superadmin.departemen.ajaxStatus']);
    });
    $routes->group('kategori', ['namespace' => 'App\Controllers\SuperAdmin'], static function ($routes) {
        $routes->get('/', 'Kategori::index', ['as' => 'superadmin.kategori']);
        $routes->get('ajaxList', 'Kategori::ajaxList', ['as' => 'superadmin.kategori.ajaxList']);
        $routes->post('ajaxSave', 'Kategori::ajaxSave', ['as' => 'superadmin.kategori.ajaxSave']);
        $routes->get('ajaxEdit/(:segment)', 'Kategori::ajaxEdit/$1', ['as' => 'superadmin.kategori.ajaxEdit']);
        $routes->post('ajaxUpdate', 'Kategori::ajaxUpdate', ['as' => 'superadmin.kategori.ajaxUpdate']);
        $routes->delete('ajaxDelete/(:segment)', 'Kategori::ajaxDelete/$1', ['as' => 'superadmin.kategori.ajaxDelete']);
        $routes->put('ajaxStatus/(:segment)', 'Kategori::ajaxStatus/$1', ['as' => 'superadmin.kategori.ajaxStatus']);
    });
    $routes->group('user', ['namespace' => 'App\Controllers\SuperAdmin'], static function ($routes) {
        $routes->get('/', 'User::index', ['as' => 'superadmin.user']);
        $routes->get('ajaxList', 'User::ajaxList', ['as' => 'superadmin.user.ajaxList']);
        $routes->post('ajaxSave', 'User::ajaxSave', ['as' => 'superadmin.user.ajaxSave']);
        $routes->get('ajaxEdit/(:segment)', 'User::ajaxEdit/$1', ['as' => 'superadmin.user.ajaxEdit']);
        $routes->post('ajaxUpdate', 'User::ajaxUpdate', ['as' => 'superadmin.user.ajaxUpdate']);
        $routes->delete('ajaxDelete/(:segment)', 'User::ajaxDelete/$1', ['as' => 'superadmin.user.ajaxDelete']);
        $routes->put('ajaxStatus/(:segment)', 'User::ajaxStatus/$1', ['as' => 'superadmin.user.ajaxStatus']);
    });
});

$routes->group('admin', static function ($routes) {
    $routes->group('dashboard', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('/', 'Dashboard::index', ['as' => 'admin.dashboard']);
    });
    $routes->group('arsip', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('/', 'Arsip::index', ['as' => 'admin.arsip']);
        $routes->get('ajaxList', 'Arsip::ajaxList', ['as' => 'admin.arsip.ajaxList']);
        $routes->post('ajaxSave', 'Arsip::ajaxSave', ['as' => 'admin.arsip.ajaxSave']);
        $routes->get('ajaxEdit/(:segment)', 'Arsip::ajaxEdit/$1', ['as' => 'admin.arsip.ajaxEdit']);
        $routes->post('ajaxUpdate', 'Arsip::ajaxUpdate', ['as' => 'admin.arsip.ajaxUpdate']);
        $routes->delete('ajaxDelete/(:segment)', 'Arsip::ajaxDelete/$1', ['as' => 'admin.arsip.ajaxDelete']);
        $routes->put('ajaxStatus/(:segment)', 'Arsip::ajaxStatus/$1', ['as' => 'admin.arsip.ajaxStatus']);
        $routes->get('view/(:segment)', 'Arsip::view/$1', ['as' => 'admin.arsip.view']);
    });
    $routes->group('kategori', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('/', 'Kategori::index', ['as' => 'admin.kategori']);
        $routes->get('ajaxList', 'Kategori::ajaxList', ['as' => 'admin.kategori.ajaxList']);
        $routes->post('ajaxSave', 'Kategori::ajaxSave', ['as' => 'admin.kategori.ajaxSave']);
    });
    $routes->group('user', ['namespace' => 'App\Controllers\Admin'], static function ($routes) {
        $routes->get('/', 'User::index', ['as' => 'admin.user']);
        $routes->get('ajaxList', 'User::ajaxList', ['as' => 'admin.user.ajaxList']);
        $routes->post('ajaxSave', 'User::ajaxSave', ['as' => 'admin.user.ajaxSave']);
        $routes->get('ajaxEdit/(:segment)', 'User::ajaxEdit/$1', ['as' => 'admin.user.ajaxEdit']);
        $routes->post('ajaxUpdate', 'User::ajaxUpdate', ['as' => 'admin.user.ajaxUpdate']);
        $routes->delete('ajaxDelete/(:segment)', 'User::ajaxDelete/$1', ['as' => 'admin.user.ajaxDelete']);
        $routes->put('ajaxStatus/(:segment)', 'User::ajaxStatus/$1', ['as' => 'admin.user.ajaxStatus']);
    });
});

$routes->group('user', static function ($routes) {
    $routes->group('dashboard', ['namespace' => 'App\Controllers\User'], static function ($routes) {
        $routes->get('/', 'Dashboard::index', ['as' => 'user.dashboard']);
    });
    $routes->group('arsip', ['namespace' => 'App\Controllers\User'], static function ($routes) {
        $routes->get('/', 'Arsip::index', ['as' => 'user.arsip']);
        $routes->get('ajaxList', 'Arsip::ajaxList', ['as' => 'user.arsip.ajaxList']);
        $routes->post('ajaxSave', 'Arsip::ajaxSave', ['as' => 'user.arsip.ajaxSave']);
        $routes->get('ajaxEdit/(:segment)', 'Arsip::ajaxEdit/$1', ['as' => 'user.arsip.ajaxEdit']);
        $routes->post('ajaxUpdate', 'Arsip::ajaxUpdate', ['as' => 'user.arsip.ajaxUpdate']);
        $routes->delete('ajaxDelete/(:segment)', 'Arsip::ajaxDelete/$1', ['as' => 'user.arsip.ajaxDelete']);
        $routes->put('ajaxStatus/(:segment)', 'Arsip::ajaxStatus/$1', ['as' => 'user.arsip.ajaxStatus']);
        $routes->get('view/(:segment)', 'Arsip::view/$1', ['as' => 'user.arsip.view']);
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
