<?php

require '../config/database.php';
require '../controllers/BirthdayController.php';
require '../models/Birthday.php';

// Inicializar la base de datos
$config = require '../config/database.php';
$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);

// Inicializar el enrutador y definir las rutas
$router = new Router();
require '../routes/api.php';

// Manejar la solicitud
$router->dispatch($_SERVER['REQUEST_URI']);