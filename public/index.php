<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/code/app/core/Router.php';
require __DIR__ . './database/database.php';
require __DIR__ . '/code/app/helpers.php';
require __DIR__ . '/../code/routes/web.php';

$router->dispatch();
