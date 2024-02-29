<?php

use lightframe\{AutoLoader, Dotenv, Debug, SessionController, Router, Db};

# Loads conf.php
require_once('conf.php');

# Register AutoLoader
require_once('Classes' . DIRECTORY_SEPARATOR . 'AutoLoader.php');
AutoLoader::register();

# Loads .env
Dotenv::load('.env');

# Enables PHP errors
if ($_ENV['DEBUG']) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

SessionController::start();

$route = new Router();
$route->bindController();