<?php

namespace Services;

use Dao\OfferDao;
use Models\Offer;

class OfferService{ 
    public $offerDao;

    public function __construct(){
        $this->offerDao = new OfferDao();
    }
    public function getAllOffer(){
        return $this->offerDao->getAllOffer();
    }
    public function getOfferById($id){
        return $this->offerDao->getOfferById($id);
    }
    public function insertOffer(Offer $offer)
    {
        return $this->offerDao->insertOffer($offer);
    }
    public function updateOffer(Offer $offer)
    {
        return $this->offerDao->updateOffer($offer);
    }
    public function deleteOffer(Offer $offer)
    {
        return $this->offerDao->deleteOffer($offer);
    }
}
?>