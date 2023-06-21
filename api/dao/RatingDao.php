<?php
namespace Dao;

use PDO;
use Configuration\Configuration;
use Interfaces\RatingDaoInterface;
use Models\Rating;


class RatingDao implements RatingDaoInterface
{
    const TABLE_NAME = 'rating';
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
        
    public function getRatingByUserId($id)
    {
        $query = "SELECT id, content_id, user_id, rating_value, comment, date_created FROM " . self::TABLE_NAME . " WHERE user_id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRatingByContentId($id)
    {
        $query = "SELECT id, content_id, user_id, rating_value, comment, date_created FROM " . self::TABLE_NAME . " WHERE content_id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertRating(Rating $rating)
    {
        $contentId = $rating->getContentId();
        $userId = $rating->getUserId();
        $ratingValue = $rating->getRatingValue();
        $comment = $rating->getComment();
        $dateCreated = $rating->getDateCreated();

        $query = "INSERT INTO " . self::TABLE_NAME . " (content_id, user_id, rating_value, comment, date_created) VALUES ($contentId, $userId, $ratingValue, '$comment', '$dateCreated')";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function updateRating(Rating $rating)
    {
        $id = $rating->getId();
        $contentId = $rating->getContentId();
        $userId = $rating->getUserId();
        $ratingValue = $rating->getRatingValue();
        $comment = $rating->getComment();
        $dateCreated = $rating->getDateCreated();

        $query = "UPDATE " . self::TABLE_NAME . " SET content_id=$contentId, user_id=$userId, rating_value=$ratingValue, comment=$comment, date_created=$dateCreated WHERE id=$id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function deleteRating(Rating $rating)
    {
        $id = $rating->getId();
        $query = "DELETE FROM " . self::TABLE_NAME . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }
}
