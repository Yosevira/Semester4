<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Tugas Pak Fajrul
// $routes->get('/', 'Profil::index'); 
$routes->get('/about','Page::about');
$routes->get('/contact','Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/tos','Page::tos');
$routes->get('/biodata','Page::biodata');

$routes->get('/pemweb','mata_kuliah::pemweb');
$routes->get('/mjk','mata_kuliah::mjk');
$routes->get('/rpl','mata_kuliah::rpl');
$routes->get('/mbd','mata_kuliah::mbd');

//Tugas Pak Miftah
$routes->get('/books','Books::index');
$routes->get('/books/detail/(:segment)','Books::detail/$1');
$routes->delete('/books/delete/(:num)', 'Books::delete/$1');
$routes->get('/books/edit/(:segment)', 'Books::edit/$1');
$routes->post('/books/update/(:num)', 'Books::update/$1');
$routes->get('/books/create', 'Books::create');
$routes->post('/books/save', 'Books::save');

$routes->get('/penulis','Penulis::index');
$routes->get('/penulis/detail/(:segment)','Penulis::detail/$1');

//grafik
$routes->get('/', 'Home::index');
$routes->get('home/apiData/(:num)', 'Home::apiData/$1');


$routes->setAutoRoute(false);