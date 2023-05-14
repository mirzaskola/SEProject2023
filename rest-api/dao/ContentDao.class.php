<?php
require_once __DIR__.'/../Config.class.php';

class ContentDao{
    const TABLE_NAME = 'content';
    private $conn;
  
    public function __construct(){
        $servername = Config::DB_HOST();
        $username = Config::DB_USERNAME();
        $password = Config::DB_PASSWORD();
        $schema = Config::DB_SCHEME();
        $port = Config::DB_PORT();
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema;port=$port", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }

      //implement pagination?
      public function get_all_content(){
        $query = "SELECT c.id, c.title, c.description, c.release_date, c.duration, c.genre, c.cover_image, c.content_type_id, AVG(r.rating_value) AS average_rating 
                  FROM content c
                  LEFT JOIN rating r ON c.id = r.content_id
                  GROUP BY c.id, c.title, c.description, c.release_date, c.duration, c.genre, c.cover_image, c.content_type_id;
                ";        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function get_content_by_id($content_id){
        $query = "SELECT * FROM ".self::TABLE_NAME." WHERE id=:content_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['content_id' => $content_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
      }

      //modify this generic insert into more appropriate one
      public function insert_content($content){
        $query = "INSERT INTO ".self::TABLE_NAME." (";
        foreach ($content as $column => $value) {
          $query .= $column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($content as $column => $value) {
          $query .= ":".$column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
    
        $stmt= $this->conn->prepare($query);
        $stmt->execute($content);
    }
    
    //this is only soft delete, we need to delete ratings also
    public function delete_content($content_id){
        $stmt = $this->conn->prepare("DELETE FROM ".self::TABLE_NAME." WHERE id=:id");
        $stmt->bindParam(':id', $content_id);
        $stmt->execute();        
    }

    // modify this generic update into more appropriate one
    public function update_content($id, $entity, $id_column = "id"){
      $query = "UPDATE ".self::TABLE_NAME." SET ";
      foreach($entity as $name => $value){
        $query .= $name ."= :". $name. ", ";
      }
      $query = substr($query, 0, -2);
      $query .= " WHERE ${id_column} = :id";
  
      $stmt= $this->conn->prepare($query);
      $entity['id'] = $id;
      $stmt->execute($entity);
  }
}

?>