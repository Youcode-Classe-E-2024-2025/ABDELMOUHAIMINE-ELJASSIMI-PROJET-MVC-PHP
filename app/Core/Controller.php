<?php

namespace App\Core;

class Controller
{
    public function view(string $view, array $data = [])
    {

        $viewPath = __DIR__ . '/../views/' . $view . '.twig';
        if (file_exists($viewPath)) {
            extract($data);
            include $viewPath;
        } else {
            die("View not found: " . $view);
        }
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }
}
