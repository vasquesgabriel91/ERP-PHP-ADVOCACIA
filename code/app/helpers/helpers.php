<?php

use App\Helpers\Redirect;
use App\Core\View;

function view(string $template, array $data = []) {
    return View::render($template, $data);
}

function redirect()
{
    global $router; 
    return new Redirect($router);
}
