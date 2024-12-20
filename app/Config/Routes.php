<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');



$routes->post('auth/register', 'AuthController::register');


$routes->group('user', ['filter' => 'jwtauth'], function ($routes) {

    $routes->get('', 'UserController::index');
    $routes->post('', 'UserController::addUsesr');
    $routes->get('(:num)', 'UserController::show/$1');
    $routes->put('(:num)', 'UserController::update/$1');
    $routes->delete('(:num)', 'UserController::delete/$1');
});

$routes->get('/', 'AuthController::index');
$routes->post('auth/login', 'AuthController::login');
$routes->get('/dashboard', 'AuthController::userDetails',['filter' => 'authGuard']);
$routes->get('/user-list', 'UserController::UserList',['filter' => 'authGuard']);
$routes->get('/add-user', 'UserController::AddUser',['filter' => 'authGuard']);
$routes->get('/view_details/(:num)', 'UserController::ViewDetails/$1',['filter' => 'authGuard']);

$routes->get('/edit-user/(:num)', 'UserController::editUser/$1',['filter' => 'authGuard']);
$routes->get('/logout', 'AuthController::logout');
$routes->get('/access-denied', 'UserController::accessDenied');