<?php

class Router {
    private $routes = [];

    public function addRoute($url, $controller, $action, $params = []) {
        $this->routes[$url] = ['controller' => $controller, 'action' => $action, 'params' => $params];
    }

    public function dispatch($uri) {
        $parsedUrl = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$parsedUrl])) {
            $route = $this->routes[$parsedUrl];
        } else {
            $match = null;
            foreach ($this->routes as $path => $routeInfo) {
                if (str_contains($path, '*')) {
                    $basePath = rtrim(strtok($path, '*'), '/');
                    if (str_starts_with($parsedUrl, $basePath)) {
                        $wildcardValue = trim(substr($parsedUrl, strlen($basePath)), '/');
                        $routeInfo['params'] = [$wildcardValue];
                        $match = $routeInfo;
                        break;
                    }
                }
            }

            if (!$match) {
                $this->sendError(404, "404 Not Found");
            }

            $route = $match;
        }

        $controllerName = $route['controller'];
        $actionName = $route['action'];
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

        $params = $route['params'] ?? [];

        $controller->$actionName(...$params);
    }

    private function sendError($code, $message) {
        http_response_code($code);
        die($message);
    }
}
