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

Flight::route('GET /user/myprofile', function(){
  $user = Flight::get('user');
  Flight::json($user);
  $userService = new UserService();
    if (isset($user['id'])){
        $data = $userService->getById($user['id']);
        unset($data['password']);
        Flight::json($data, 200);
    }
    else{
        Flight::json("User is not logged in", 403);
    }
});

Flight::route('PUT /user/login', function(){
  $loginData = Flight::request()->data->getData();  
  $userService = new UserService();
  $response = $userService->login($loginData);
  if(isset($response['token'])){
    Flight::set('user', $loginData);
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