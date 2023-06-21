<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

use Configuration\Configuration;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. '/configuration/Configuration.php';

foreach(glob(__DIR__."/models/*.php") as $model) require_once $model;
foreach(glob(__DIR__."/interfaces/*.php") as $interface) require_once $interface;
foreach(glob(__DIR__."/dao/*.php") as $dao) require_once $dao;
foreach(glob(__DIR__."/builders/*.php") as $builder) require_once $builder;
foreach(glob(__DIR__."/services/*.php") as $service) require_once $service;
foreach(glob(__DIR__."/routes/*.php") as $route) require_once $route;

Flight::route('/*', function(){
    $path = Flight::request()->url;
    $method = Flight::request()->method;
    if ($path == '/login' || $path == '/docs.json' || $path == '/toprated' || $path == '/allnames' || $path == '/offers' || ($path == '/games' && $method == 'GET') || str_contains($path, 'games/') || $path == '/signup' || $path == '/games-search' || str_contains($path, 'reviews/') ) return TRUE; // exclude login route from middleware
  
    $headers = getallheaders();
    if (@!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"], 403);
      return FALSE;
    }else{
      try {
        $decoded = (array)JWT::decode($headers['Authorization'], new Key(Configuration::JWT_SECRET(), 'HS256'));
        //Flight::set('user', $decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"], 403);
        return FALSE;
      }
    }
  });

Flight::start();

?>