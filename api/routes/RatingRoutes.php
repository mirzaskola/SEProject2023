<?php

use Services\RatingService;
use Models\Rating;

Flight::route('GET /rating/user/@id', function($id){
    $ratingService = new RatingService();
    $data = $ratingService->getRatingByUserId($id);
    Flight::json($data);
});

Flight::route('GET /rating/content/@id', function($id){
    $ratingService = new RatingService();
    $response = $ratingService->getRatingByContentId($id);
    Flight::json($response);
});

Flight::route('POST /rating', function(){
    $ratingService = new RatingService();
    $insertData = Flight::request()->data->getData();
    
    $newRating = new Rating();
    $newRating->setUserId(1);
    $newRating->setContentId($insertData['contentId']);
    $newRating->setRatingValue($insertData['ratingValue']);
    $newRating->setComment($insertData['comment']);
    $newRating->setDateCreated(date("Y/m/d"));

    $ratingService->insertRating($newRating);
});

Flight::route('PUT /rating', function(){
    $ratingService = new RatingService();
    $insertData = Flight::request()->data->insertData;

    $newRating = new Rating();
    $newRating->setId($insertData['id']);
    $newRating->setUserId($insertData['userId']);
    $newRating->setContentId($insertData['contentId']);
    $newRating->setComment($insertData['comment']);
    $newRating->setDateCreated($insertData['dateCreated']);

    $ratingService->updateRating($newRating);
    Flight::json($insertData);
});

Flight::route('DELETE /rating', function(){
    $ratingService = new RatingService();
    $insertData = Flight::request()->data->insertData;

    $newRating = new Rating();
    $newRating->setId($insertData['id']);
    $newRating->setUserId($insertData['userId']);
    $newRating->setContentId($insertData['contentId']);
    $newRating->setComment($insertData['comment']);
    $newRating->setDateCreated($insertData['dateCreated']);

    $ratingService->deleteRating($newRating);
    Flight::json($insertData);
});
?>