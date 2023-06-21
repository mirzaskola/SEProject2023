<?php

use Services\UserService;

Flight::route('POST /user/signup', function(){
  $signUpData = Flight::request()->data->getData();
  // $sign_up_data['password'] = md5($sign_up_data['password']);
  // $sign_up_data['user_role'] = 0;
  $userService = new UserService();
  $response = $userService->signup($signUpData);
  Flight::json(["message" => $response['message']], $response['code']);
});

Flight::route('POST /user/login', function(){
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

Flight::route('POST /user/myprofile', function(){
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

Flight::route('PUT /user/login', function(){
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

Flight::route('POST /user/login', function(){
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