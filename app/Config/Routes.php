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
$routes->post('login/forgotpassword', 'Login::forgotpassword'); 
$routes->get('login/verify', 'Login::verify');
$routes->get('login/logout', 'Login::logout');
$routes->post('register', 'Login::register');
// $routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/user_management', 'UserManagement::index');

$routes->get('building', 'Building::index');
$routes->get('building/detail/(:any)', 'Building::detail/$1');
$routes->get('building/edit/(:any)', 'Building::edit/$1');
$routes->post('building/save', 'Building::save');
$routes->delete('building/delete/(:any)', 'Building::delete/$1');
$routes->get('building/add', 'Building::add');

$routes->get('facility', 'Facility::index');
$routes->get('/facility/detail/(:any)', 'Facility::detail/$1');
$routes->get('/facility/edit/(:any)', 'Facility::edit/$1');
$routes->post('/facility/save', 'Facility::save');
$routes->delete('/facility/delete/(:any)', 'Facility::delete/$1');
$routes->get('/facility/add/', 'Facility::add');

$routes->get('feedback', 'Feedback::index');
$routes->get('/feedback/detail/(:any)', 'Feedback::detail/$1');


$routes->get('/facilities_type', 'FacilitiesType::index');
$routes->get('/facilities_type/edit/(:any)', 'FacilitiesType::edit/$1');
$routes->post('/facilities_type/save', 'FacilitiesType::save');
$routes->delete('/facilities_type/delete/(:any)', 'FacilitiesType::delete/$1');
$routes->get('/facilities_type/add/', 'FacilitiesType::add');

$routes->get('/reservation', 'Reservation::index');
$routes->get('reservation/detail/(:any)', 'Reservation::detail/$1');
$routes->get('reservation/add', 'Reservation::add');
$routes->get('reservation/edit/(:any)', 'Reservation::edit/$1');
$routes->get('reservation/feedback/(:any)', 'Reservation::feedback/$1');
$routes->post('reservation/submit_feedback', 'Reservation::submit_feedback');
$routes->post('reservation/save', 'Reservation::save');
$routes->post('reservation/cancel/(:any)', 'Reservation::cancel/$1');
$routes->post('reservation/approval', 'Reservation::approval');

$routes->get('data/dashboardSummary', 'Data::dashboardSummary');
$routes->get('data/userManagement', 'Data::userManagement');
$routes->get('data/userManagement/(:any)', 'Data::userManagement/$1');

$routes->get('data/building/(:any)', 'Data::building/$1');
$routes->get('data/building_detail/(:any)', 'Data::building_detail/$1');
$routes->get('data/facility/(:any)', 'Data::facility/$1');
$routes->post('data/getFeedback', 'Data::getFeedback');
$routes->get('data/facilities_type/(:any)', 'Data::facilities_type/$1');
$routes->get('data/reservationSummary', 'Data::reservationSummary');
$routes->get('data/userSummary', 'Data::userSummary');
$routes->get('data/buildingSummary', 'Data::buildingSummary');
$routes->get('data/buildingDetailSummary/(:any)', 'Data::buildingDetailSummary/$1');
$routes->get('data/facilitySummary', 'Data::facilitySummary');
$routes->get('data/loadAgenda/(:any)', 'Data::loadAgenda/$1');
$routes->post('data/reservation/(:any)', 'Data::reservation/$1');

$routes->get('user_management/profile/(:any)', 'UserManagement::profile/$1');
$routes->get('user_management/delete/(:any)', 'UserManagement::delete/$1');
$routes->get('user_management/edit/(:any)', 'UserManagement::edit/$1');
$routes->post('user_management/save', 'UserManagement::save');
$routes->delete('user_management/delete/(:any)', 'UserManagement::delete/$1');
$routes->get('user_management/add', 'UserManagement::add');

$routes->group('api', function($routes) {
    $routes->get('reservations', 'Api\ReservationController::index');    
    $routes->get('reservations/facility/(:any)', 'Api\ReservationController::byFacility/$1');
    $routes->get('reservations/(:num)', 'Api\ReservationController::show/$1');
    $routes->post('reservations', 'Api\ReservationController::create');
    $routes->put('reservations/(:num)', 'Api\ReservationController::update/$1');
    $routes->delete('reservations/(:num)', 'Api\ReservationController::delete/$1');
    
    $routes->get('facility', 'Api\FacilityController::index');    
    $routes->get('facility/(:any)', 'Api\FacilityController::show/$1');
    $routes->post('facility', 'Api\FacilityController::create');
    $routes->put('facility/(:num)', 'Api\FacilityController::update/$1');
    $routes->delete('facility/(:num)', 'Api\FacilityController::delete/$1');
});
$routes->set404Override('App\Controllers\Error::show404');
