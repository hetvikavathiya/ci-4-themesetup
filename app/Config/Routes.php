<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'LoginController::index', ['filter' => 'Noauth']);

// $routes->group('/', ['filter' => 'Noauth'], function ($routes) {
// });
$routes->match(['get', 'post'], '/category', 'CategoryController::index');
$routes->group('/', ['filter' => 'Auth'], function ($routes) {
    $routes->get('/dashboard', 'UserController::index');
    $routes->match(['get', 'post'], '/users', 'UserController::users');
    $routes->get('/deleteuser/(:any)', 'UserController::deleteuser/$1');
    $routes->match(['get', 'post'], '/edituser/(:any)', 'UserController::edituser/$1');

    $routes->get('/deletecategory/(:any)', 'CategoryController::deletecategory/$1');
    $routes->match(['get', 'post'], '/editcategory/(:any)', 'CategoryController::editcategory/$1');

    $routes->match(['get', 'post'], '/product', 'ProductController::index');
    $routes->match(['get', 'post'], '/getlist', 'ProductController::getlist');
    $routes->get('/deleteproduct/(:any)', 'ProductController::deleteproduct/$1');
    $routes->match(['get', 'post'], '/editproduct/(:any)', 'ProductController::editproduct/$1');


    $routes->match(['get', 'post'], '/change_password', 'UserController::change_password');
    $routes->get('logout', 'UserController::logout');
});
