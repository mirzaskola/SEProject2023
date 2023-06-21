<?php
namespace Dao;

use PDO;
use Configuration\Configuration;
use Interfaces\OfferDaoInterface;
use Models\Offer;


class OfferDao implements OfferDaoInterface
{
    const TABLE_NAME = 'offer';
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
    public function getAllOffer()
    {
        $query = "SELECT id, partner_name, description, code, is_active FROM " . self::TABLE_NAME;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOfferById($id)
    {
        $query = "SELECT id, partner_name, description, code, is_active FROM " . self::TABLE_NAME . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }
    
    public function insertOffer(Offer $offer)
    {
        $partnerName = $offer->getPartnerName();
        $description = $offer->getDescription();
        $code = $offer->getCode();
        $isActive = $offer->getIsActive();

        $query = "INSERT INTO " . self::TABLE_NAME . " (partner_name, description, code, is_active) VALUES ('$partnerName', '$description', '$code', $isActive)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function updateOffer(Offer $offer)
    {
        $id = $offer->getId();
        $partnerName = $offer->getPartnerName();
        $description = $offer->getDescription();
        $code = $offer->getCode();
        $isActive = $offer->getIsActive();

        $query = "UPDATE " . self::TABLE_NAME . " SET partner_name='$partnerName', description='$description', code='$code', is_active=$isActive WHERE id=$id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    }
    public function deleteOffer(Offer $offer)
    {
        $id = $offer->getId();
        $query = "DELETE FROM " . self::TABLE_NAME . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }
}
