<?php
session_start();
require_once "vendor/autoload.php";
require_once __DIR__ . "/application/config/constants.php";

use Config\Router;

$r = new Router;
$r->dispatch($_SERVER["REQUEST_URI"]);
