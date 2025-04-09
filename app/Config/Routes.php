<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/capstone', 'Home::index');
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index'); 
$routes->post('login/auth', 'Login::auth'); 
$routes->post('login/checkOTP', 'Login::checkOTP'); 
$routes->post('login/resendOTP', 'Login::resendOTP'); 
$routes->get('login/verify', 'Login::verify');
$routes->get('login/logout', 'Login::logout');
$routes->post('register', 'Login::register');
// $routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/user_management', 'UserManagement::index');

$routes->get('/building', 'Building::index');
$routes->get('/building/detail/(:any)', 'Building::detail/$1');
$routes->get('/building/edit/(:any)', 'Building::edit/$1');
$routes->post('/building/save', 'Building::save');
$routes->delete('/building/delete/(:any)', 'Building::delete/$1');
$routes->get('/building/add', 'Building::add');

$routes->get('/facility', 'Facility::index');
$routes->get('/facility/detail/(:any)', 'Facility::detail/$1');
$routes->get('/facility/edit/(:any)', 'Facility::edit/$1');
$routes->post('/facility/save', 'Facility::save');
$routes->delete('/facility/delete/(:any)', 'Facility::delete/$1');
$routes->get('/facility/add/', 'Facility::add');

$routes->get('/facilities_type', 'FacilitiesType::index');
$routes->get('/facilities_type/edit/(:any)', 'FacilitiesType::edit/$1');
$routes->post('/facilities_type/save', 'FacilitiesType::save');
$routes->delete('/facilities_type/delete/(:any)', 'FacilitiesType::delete/$1');
$routes->get('/facilities_type/add/(:any)', 'FacilitiesType::add/$1');

$routes->get('/reservation', 'Reservation::index');
$routes->get('/reservation_detail', 'ReservationDetail::index');

$routes->get('data/dashboardSummary', 'Data::dashboardSummary');
$routes->get('data/userManagement', 'Data::userManagement');
$routes->get('data/userManagement/active', 'Data::userManagement');
$routes->get('data/userManagement/inactive', 'Data::userManagement');
$routes->get('data/userManagement/pending', 'Data::userManagement');

$routes->get('data/building/(:any)', 'Data::building/$1');
$routes->get('data/facility/(:any)', 'Data::facility/$1');
$routes->get('data/facilities_type/(:any)', 'Data::facilities_type/$1');

$routes->get('user_management/profile/(:any)', 'UserManagement::profile/$1');
$routes->get('user_management/delete/(:any)', 'UserManagement::delete/$1');
$routes->get('user_management/edit/(:any)', 'UserManagement::edit/$1');
$routes->post('user_management/save', 'UserManagement::save');
$routes->delete('user_management/delete/(:any)', 'UserManagement::delete/$1');
$routes->get('user_management/add/(:any)', 'UserManagement::add/$1');

$routes->set404Override('App\Controllers\Error::show404');
