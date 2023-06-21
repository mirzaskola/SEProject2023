<?php

namespace Dao;

use Configuration\Configuration;
use PDO;

use Interfaces\UserDaoInterface;
use Models\User;


class UserDao implements UserDaoInterface
{
    const TABLE_NAME = 'user';
    private $conn;
    public function __construct()
    {
        $servername = Configuration::DB_HOST();
        $username = Configuration::DB_USERNAME();
        $password = Configuration::DB_PASSWORD();
        $schema = Configuration::DB_SCHEME();
        $port = Configuration::DB_PORT();
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema;port=$port", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getById($id)
    {
        $query = "SELECT id, username, email, password, user_role FROM " . self::TABLE_NAME . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }

    public function getByUsername($username)
    {
        $query = "SELECT id, username, email, password, user_role FROM " . self::TABLE_NAME . " WHERE username=:username";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }

    public function getByEmail($email)
    {
        $query = "SELECT id, username, email, password, user_role FROM " . self::TABLE_NAME . " WHERE email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }

    public function insertUser(User $user)
    {
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = md5($user->getPassword());
        $userRole = $user->getUserRole();
        $query = "INSERT INTO " . self::TABLE_NAME . " (username, email, password, user_role) VALUES ('$username', '$email', '$password', $userRole)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function updateUser(User $user)
    {
        $id = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = md5($user->getPassword());
        $userRole = $user->getUserRole();
        $query = "UPDATE " . self::TABLE_NAME . " SET username='$username', email='$email', password='$password', user_role=$userRole WHERE id=$id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }

    public function deleteUser(User $user)
    {
        $id = $user->getId();
        $query = "DELETE FROM " . self::TABLE_NAME . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }
}
