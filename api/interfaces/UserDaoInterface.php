<?php

namespace Interfaces;

use Models\User;

interface UserDaoInterface
{
    public function getById($id);
    public function getByEmail($email);
    public function getByUsername($username);
    public function insertUser(User $user);
    public function deleteUser(User $user);
    public function updateUser(User $user);
}
