<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::processRegister');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::processLogin');
$routes->get('logout', 'Auth::logout');
$routes->post('dashboard/create', 'Dashboard::create');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/edit/(:num)', 'Dashboard::edit/$1');
$routes->post('dashboard/update/(:num)', 'Dashboard::update/$1');
$routes->post('dashboard/delete/(:num)', 'Dashboard::delete/$1');