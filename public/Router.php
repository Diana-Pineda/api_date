<?php

class Router
{
    private $routes = [];
    private $conn;

    public function __construct()
    {
        // Inicializa las rutas
        $this->routes = [];
    }

    // Define routes
    public function get($route, $action)
    {
        $this->routes['GET'][$route] = $action;
    }

    public function post($route, $action)
    {
        $this->routes['POST'][$route] = $action;
    }

    public function put($route, $action)
    {
        $this->routes['PUT'][$route] = $action;
    }

    public function delete($route, $action)
    {
        $this->routes['DELETE'][$route] = $action;
    }

    // Set the database connection
    public function setConnection($conn)
    {
        $this->conn = $conn;
    }


    // Dispatch the request to the appropriate controller method
    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$method] as $route => $action) {
            // Check if route matches the URI
            if ($route === $uri) {
                list($controllerName, $methodName) = explode('@', $action);
                if (class_exists($controllerName)) {
                    $controller = new $controllerName($this->conn);
                    if (method_exists($controller, $methodName)) {
                        $controller->$methodName();
                        return;
                    } else {
                        http_response_code(500);
                        echo json_encode(['message' => 'Method not found']);
                        return;
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(['message' => 'Controller not found']);
                    return;
                }
            }
        }

        // Handle 404 Not Found
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
    }
}
