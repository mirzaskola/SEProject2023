<?php

namespace Interfaces;

use Models\Rating;

interface RatingDaoInterface
{
    public function getRatingByUserId($id);
    public function getRatingByContentId($id);
    public function insertRating(Rating $rating);
    public function updateRating(Rating $rating);
    public function deleteRating(Rating $rating);
}
