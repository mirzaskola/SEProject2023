<?php

namespace Interfaces;

use Models\Content;

interface ContentBuilderInterface
{    
    public function getContentGenre($content);
    public function getContentRating($content);
    public function getContentReviews($content);
}