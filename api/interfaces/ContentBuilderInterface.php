<?php

namespace Interfaces;

use Models\Content;

interface ContentBuilderInterface
{    
    public function getContentGenre($id): Content;
    public function getContentRating($id): Content;
}