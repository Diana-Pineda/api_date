<?php

// Definir rutas API
$router->get('/cumpleaños', 'BirthdayController@index');
$router->get('/cumpleaños/{id}', 'BirthdayController@show');
$router->post('/cumpleaños', 'BirthdayController@store');
$router->put('/cumpleaños/{id}', 'BirthdayController@update');
$router->delete('/cumpleaños/{id}', 'BirthdayController@destroy');