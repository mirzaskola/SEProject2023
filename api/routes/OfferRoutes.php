<?php

use Services\OfferService;
use Models\Offer;

Flight::route('GET /offer', function(){
    $offerService = new OfferService();
    $data = $offerService->getAllOffer();
    Flight::json($data);
});

Flight::route('GET /offer/@id', function($id){
    $offerService = new OfferService();
    $response = $offerService->getOfferById($id);
    Flight::json($response);
});

Flight::route('POST /offer', function(){
    $offerService = new OfferService();
    $insertData = Flight::request()->data->insertData;

    $newOffer = new Offer();
    $newOffer->setPartnerName($insertData['partnerName']);
    $newOffer->setDescription($insertData['description']);
    $newOffer->setCode($insertData['code']);
    $newOffer->setIsActive($insertData['isActive']);

    $offerService->insertOffer($newOffer);
    Flight::json($insertData);
});

Flight::route('PUT /offer', function(){
    $offerService = new OfferService();
    $insertData = Flight::request()->data->insertData;

    $newOffer = new Offer();
    $newOffer->setId($insertData['id']);
    $newOffer->setPartnerName($insertData['partnerName']);
    $newOffer->setDescription($insertData['description']);
    $newOffer->setCode($insertData['code']);
    $newOffer->setIsActive($insertData['isActive']);

    $offerService->updateOffer($newOffer);
    Flight::json($insertData);
});

Flight::route('DELETE /offer', function(){
    $offerService = new OfferService();
    $insertData = Flight::request()->data->insertData;

    $newOffer = new Offer();    
    $newOffer->setId($insertData['id']);
    $newOffer->setPartnerName($insertData['partnerName']);
    $newOffer->setDescription($insertData['description']);
    $newOffer->setCode($insertData['code']);
    $newOffer->setIsActive($insertData['isActive']);

    $offerService->deleteOffer($newOffer);
    Flight::json($insertData);
});

?>