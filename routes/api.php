<?php

require_once __DIR__ . '/../public/Router.php';

// Define API routes
$router = new Router();
$router->get('/cumpleaños', 'BirthdayController@index');
$router->get('/cumpleaños/{id}', 'BirthdayController@show');
$router->post('/cumpleaños', 'BirthdayController@store');
$router->put('/cumpleaños/{id}', 'BirthdayController@update');
$router->delete('/cumpleaños/{id}', 'BirthdayController@destroy');