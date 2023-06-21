<?php

namespace Services;

use Firebase\JWT\JWT;
use Configuration\Configuration;
use Dao\UserDao;
use Models\User;

class UserService{ 
    public $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }
    public function getById($id)
    {
        return $this->userDao->getById($id);
    }
    public function getByUsername($username)
    {
        return $this->userDao->getByUsername($username);
    }
    public function getByEmail($email)
    {
        return $this->userDao->getByEmail($email);
    }
    public function insertUser(User $user)
    {
        return $this->userDao->insertUser($user);
    }
    public function updateUser(User $user)
    {
        return $this->userDao->updateUser($user);
    }
    public function deleteUser(User $user)
    {
        return $this->userDao->deleteUser($user);
    }
    public function signup($signUpData){
        $user = $this->userDao->getByEmail($signUpData['email']);
        if(isset($user['id'])){
            return (['message' => "User already exists", 'code' => 409]);
        }
        else{
            $signUpData['password'] = md5($signUpData['password']);
            $signUpData['user_role'] = 0;
            $this->userDao->insertUser($signUpData);
            return (['message' => "Signed up successfully", 'code' => 200]);
        }
    }
    public function login($loginData){
    
        $user = $this->userDao->getByEmail($loginData['email']);
        if (isset($user['id'])){
            if($user['password'] == md5($loginData['password'])){
                unset($user['password']);
                $jwt = JWT::encode($user, Configuration::JWT_SECRET(), 'HS256');
                return (['message' => $jwt, 'code' => 200]);
            }else{
                return (['message' => "Wrong password", 'code' => 404]);
            }
        }else{
            return (['message' => "User doesn't exist", 'code' => 404]);
        }
    }
    public function checkUserRole($user){
        $fetchedUser = $this->userDao->getByEmail($user['email']);
        if (isset($fetchedUser['id'])){
            if($fetchedUser['user_role'] == 1){
                return "admin";
            }
            if($fetchedUser['user_role'] == 0){
                return "user";
            }
        }
        else{
            return "guest";
        }
        
    }
}
?>