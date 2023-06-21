<?php

use Interfaces\ContentBuilderInterface;
use Dao\ContentDao;

class MovieBuilder //implements ContentBuilderInterface
{
    protected $contentDao;
    protected $movie;
    protected function reset(): void
    {
        $this->movie = new \stdClass();
    }
    public function __construct(){
        $this->contentDao = new ContentDao();
    }
    //public function getContentGenre($id): Content;
    //public function getContentRating($id): Content;
}