<?php
namespace App\Core;

class Request {
    public function body(): array {
        $json = json_decode(file_get_contents('php://input'), true);

        if ($json && is_array($json)) {
            return $json;
        }

        return $_POST;
    }

}