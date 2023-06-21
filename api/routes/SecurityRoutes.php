<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Services\UserService;

Flight::route('POST /signup', function(){
  $signUpData = Flight::request()->data->getData();
  // $sign_up_data['password'] = md5($sign_up_data['password']);
  // $sign_up_data['user_role'] = 0;
  $userService = new UserService();
  $response = $userService->signup($signUpData);
  Flight::json(["message" => $response['message']], $response['code']);
});

Flight::route('POST /login', function(){
  $loginData = Flight::request()->data->getData();  
  $userService = new UserService();
  $response = $userService->login($loginData);
  if(isset($response['token'])){
      Flight::json($response['token'], 200); 
  }
  else{
      Flight::json(["message" => $response['message']], $response['code']);
  }
});

?>