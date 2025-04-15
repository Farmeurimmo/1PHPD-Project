<?php

abstract class BaseController {
    private $models = [];

    protected function getModel($modelName) {
        if (!isset($this->models[$modelName])) {
            $modelClass = ucfirst($modelName);
            $modelPath = __DIR__ . "/../models/" . $modelClass . ".php";

            if (!file_exists($modelPath)) {
                throw new Exception("Model '$modelClass' not found.");
            }

            require_once $modelPath;
            $this->models[$modelName] = new $modelClass();
        }

        return $this->models[$modelName];
    }

    protected function renderView($view, $data = []) {
        $view = __DIR__ . "/../views/" . $view . ".php";

        if (!file_exists($view)) {
            die("Error: View '$view' not found.");
        }

        extract($data);

        include_once __DIR__ . "/../views/commons/CommonLayout.php";
    }
}