<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Profil::index');
$routes->get('/about','Page::about');
$routes->get('/contact','Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/tos','Page::tos');
$routes->get('/biodata','Page::biodata');
$routes->get('/pemweb','mata_kuliah::pemweb');
$routes->get('/mjk','mata_kuliah::mjk');
$routes->get('/rpl','mata_kuliah::rpl');
$routes->get('/mbd','mata_kuliah::mbd');
$routes->setAutoRoute(false);