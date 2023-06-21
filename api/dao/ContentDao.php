<?php
namespace Dao;

use Models\SearchRequest;
use PDO;
use Configuration\Configuration;
use Interfaces\ContentDaoInterface;
use Models\Content;


class ContentDao implements ContentDaoInterface
{
    const TABLE_NAME = 'content';
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
    public function getAllContent()
    {
        $query = "SELECT id, title, description, release_date, duration, genres, cover_image, content_type_id FROM " . self::TABLE_NAME;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getContentById($id)
    {
        $query = "SELECT id, title, description, release_date, duration, genres, cover_image, content_type_id FROM " . self::TABLE_NAME . " WHERE id=:content_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['content_id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }
    public function getContentByType($content_type)
    {
        $query = "SELECT id, title, description, release_date, duration, genres, cover_image, content_type_id FROM " . self::TABLE_NAME . " WHERE content_type_id=:content_type";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['content_type' => $content_type]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertContent(Content $content)
    {
        $title = $content->getTitle();
        $description = $content->getDescription();
        $releaseDate = $content->getReleaseDate();
        $duration = $content->getDuration();
        $genres = implode(", ", $content->getGenres());
        $coverImage = $content->getCoverImage();
        $contentTypeId = $content->getContentTypeId();
        $query = "INSERT INTO " . self::TABLE_NAME . " (title, description, release_date, duration, genres, cover_image, content_type_id) VALUES ('$title', '$description', '$releaseDate', $duration, '$genres', '$coverImage', $contentTypeId)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function updateContent(Content $content)
    {
        $id = $content->getId();
        $title = $content->getTitle();
        $description = $content->getDescription();
        $releaseDate = $content->getReleaseDate();
        $duration = $content->getDuration();
        $genres = implode(", ", $content->getGenres());
        $coverImage = $content->getCoverImage();
        $contentTypeId = $content->getContentTypeId();

        $query = "UPDATE " . self::TABLE_NAME . " SET title='$title', description='$description', release_date='$releaseDate', duration=$duration, genres='$genres', cover_image='$coverImage', content_type_id=$contentTypeId WHERE id=$id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function deleteContent(Content $content)
    {
        $id = $content->getId();
        $query = "DELETE FROM " . self::TABLE_NAME . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }
    public function getContentBySearch(SearchRequest $request)
    {
        $searchInput = $request->getSearchInput();
        $contentType = $request->getContentType();
        
        $query = "SELECT id, title, description, release_date, duration, genres, cover_image, content_type_id
                  FROM content
                  WHERE content_type_id=:content_type AND lower(title) LIKE '%".strtolower($searchInput)."%';";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(['content_type' => $contentType]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
}
