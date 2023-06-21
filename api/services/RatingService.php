<?php

namespace Services;

use Dao\RatingDao;
use Models\Rating;

class RatingService{ 
    public $ratingDao;

    public function __construct()
    {
        $this->ratingDao = new RatingDao();
    }
    public function getRatingByUserId($id)
    {
        return $this->ratingDao->getRatingByUserId($id);
    }
    public function getRatingByContentId($id)
    {
        return $this->ratingDao->getRatingByContentId($id);
    }
    public function insertRating(Rating $rating)
    {
        return $this->ratingDao->insertRating($rating);
    }
    public function updateRating(Rating $rating)
    {
        return $this->ratingDao->updateRating($rating);
    }
    public function deleteRating(Rating $rating)
    {
        return $this->ratingDao->deleteRating($rating);
    }
}
?>