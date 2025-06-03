<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//First time loaded
$routes->get('/', 'Kriteria::view');


// Data Kriteria
$routes->get('kriteria', 'Kriteria::view');
$routes->post('addKriteria', 'Kriteria::add');
$routes->post('editKriteria/(:any)', 'Kriteria::editKriteria/$1');
$routes->get('deleteKriteria/(:any)', 'Kriteria::delete/$1');
