<?php

declare(strict_types=1);

namespace App;
use App\Controller\UsersController;
require_once("./src/utils/debug.php");
require_once("./src/Controller/UsersController.php");

$request = [
    "get" => $_GET,
    "post" => $_POST
];

(new UsersController($request))->run();



