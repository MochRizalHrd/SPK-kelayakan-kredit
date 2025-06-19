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

// Data Konsumen
$routes->get('konsumen', 'Konsumen::view');
$routes->post('addKonsumen', 'Konsumen::add');
$routes->post('editKonsumen/(:any)', 'Konsumen::editKonsumen/$1');
$routes->get('deleteKonsumen/(:any)', 'Konsumen::delete/$1');

// Pembobotan Nilai Kriteria
$routes->get('pembobotan', 'Pembobotan::view');
$routes->post('addPembobotan', 'Pembobotan::add');
$routes->post('editPembobotan/(:any)', 'Pembobotan::editPembobotan/$1');
$routes->get('deletePembobotan/(:any)', 'Pembobotan::deletePembobotan/$1');

// Rating Kecocokan Nilai
$routes->get('rating_nilai', 'Rating::view');
$routes->post('addRating', 'Rating::add');
$routes->post('editRating/(:any)', 'Rating::editRating/$1');
$routes->get('deleteRating/(:any)', 'Rating::deleteRating/$1');
