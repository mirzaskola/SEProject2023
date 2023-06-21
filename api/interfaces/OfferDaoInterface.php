<?php

namespace Interfaces;

use Models\Offer;

interface OfferDaoInterface
{
    
    public function getAllOffer();
    public function getOfferById($id);
    public function insertOffer(Offer $offer);
    public function updateOffer(Offer $offer);
    public function deleteOffer(Offer $offer);
}
