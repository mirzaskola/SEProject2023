<?php
namespace Dao;

use PDO;
use Configuration\Configuration;
use Interfaces\GenreDaoInterface;
use Models\Genre;


class GenreDao implements GenreDaoInterface
{
    const TABLE_NAME = 'genre';
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
    
    public function getAllGenre()
    {
        $query = "SELECT id, title, description, release_date, duration, genre, cover_image, content_type_id FROM " . self::TABLE_NAME;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGenreById($id)
    {
        $query = "SELECT id, title, description, release_date, duration, genre, cover_image, content_type_id FROM " . self::TABLE_NAME . " WHERE id=:content_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['content_id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }
    
    public function getGenreByContentId($id)
    {
        
    }
    public function insertGenre(Genre $genre)
    {
        
    }
    public function updateGenre(Genre $genre)
    {
        
    }
    public function deleteGenre(Genre $genre)
    {
        $id = $genre->getId();
        $query = "DELETE FROM " . self::TABLE_NAME . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }
}
