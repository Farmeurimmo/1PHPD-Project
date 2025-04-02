<?php

class Router {
    private $routes = [];

    public function addRoute($url, $controller, $action) {
        $this->routes[$url] = ['controller' => $controller, 'action' => $action];
    }

    public function dispatch($uri) {
        //FIXME: redirect to 404 page if route not found or if controller or action not found

        $parsedUrl = parse_url($uri, PHP_URL_PATH);
        if (!isset($this->routes[$parsedUrl])) {
            $this->sendError(404, "404 Not Found");
        }

        $controllerName = $this->routes[$uri]['controller'];
        $actionName = $this->routes[$uri]['action'];
        $controllerFile = __DIR__ . "/../controllers/" . $controllerName . ".php";

        if (!file_exists($controllerFile)) {
            $this->sendError(404, "Error: Controller file '$controllerFile' not found.");
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            $this->sendError(500, "Error: Controller class '$controllerName' not found.");
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $actionName)) {
            $this->sendError(500, "Error: Method '$actionName' not found in controller '$controllerName'.");
        }

        $controller->$actionName();
    }

    private function sendError($code, $message) {
        http_response_code($code);
        die($message);
    }
}
