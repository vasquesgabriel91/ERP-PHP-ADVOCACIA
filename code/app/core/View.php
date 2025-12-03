<?php
namespace App\Core;

class View {
    public static function render($template, array $data = []) {
        extract($data);
        $path =  __DIR__ . "../views/$template.php";

        if(!file_exists($path)) {
            throw new \Exception("View file $template not found");
        }
        require $path;
    }
}