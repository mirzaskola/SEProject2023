<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. '/configuration/Configuration.php';

foreach(glob(__DIR__."/models/*.php") as $model) require_once $model;
foreach(glob(__DIR__."/interfaces/*.php") as $interface) require_once $interface;
foreach(glob(__DIR__."/dao/*.php") as $dao) require_once $dao;
foreach(glob(__DIR__."/builders/*.php") as $builder) require_once $builder;
foreach(glob(__DIR__."/services/*.php") as $service) require_once $service;
foreach(glob(__DIR__."/routes/*.php") as $route) require_once $route;

Flight::start();

?>