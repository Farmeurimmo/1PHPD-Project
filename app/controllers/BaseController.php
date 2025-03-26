<?php

abstract class BaseController {
    protected function renderView($view, $data = []) {
        $view = __DIR__ . "/../views/" . $view . ".php";

        if (!file_exists($view)) {
            die("Error: View '$view' not found.");
        }

        extract($data);

        ob_start();
        include_once $viewFile;
        $content = ob_get_clean(); // Store the view output

        include_once __DIR__ . "/../views/commons/CommonLayout.php";
    }
}