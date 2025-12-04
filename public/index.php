<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../code/app/core/Router.php';
require __DIR__ . '/../code/database/database.php';
require __DIR__ . '/../code/app/helpers/helpers.php';
require __DIR__ . '/../code/app/routes/web.php';

$router->dispatch();
