<?php

require_once __DIR__ . '/../public/Router.php';

// Define API routes
$router = new Router();
$router->get('/events', 'BirthdayController@index');
$router->get('/events/{id}', 'BirthdayController@show');
$router->post('/events', 'BirthdayController@store');
$router->put('/events/{id}', 'BirthdayController@update');
$router->delete('/events/{id}', 'BirthdayController@destroy');