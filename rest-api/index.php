<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/services/ContentService.class.php';

Flight::register('contentService', 'ContentService');



Flight::route('/', function(){
    echo 'hello world!';
  });


require_once __DIR__.'/routes/SecurityRoutes.php';
require_once __DIR__.'/routes/ContentRoutes.php';

Flight::start();

?>