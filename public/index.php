<?php

// Include the necessary files
require_once '../config/database.php';
require_once '../controllers/BirthdayController.php';
require_once '../models/Birthday.php';
require_once 'Router.php';

// Create a new instance of the Database class and get the database connection
$database = new Database();
$db = $database->getConnection();

// Create a new instance of the Router class
$router = new Router();

// Set the database connection in the Router instance
$router->setConnection($db);

// Initialize the routes from the api.php file
require_once '../routes/api.php';

// Handle the incoming request based on the request URI
$router->dispatch($_SERVER['REQUEST_URI']);
