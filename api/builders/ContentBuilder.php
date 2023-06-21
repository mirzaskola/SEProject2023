<?php

namespace Builders;

use Interfaces\ContentBuilderInterface;

use Dao\ContentDao;
use Dao\RatingDao;
use Dao\GenreDao;

use Models\Content;
use Models\Rating;

class ContentBuilder implements ContentBuilderInterface
{
    protected $contentDao;
    protected $ratingDao;
    protected $genreDao;
    protected $content;
    protected function reset(): void
    {
        $this->content = new Content();
    }
    public function __construct(){
        $this->contentDao = new ContentDao();
        $this->ratingDao = new RatingDao();
        $this->genreDao = new GenreDao();
    }
    public function getContentGenre($content)
    {
        $genreIds = explode(" ", $content['genres']);
        $genreNames = array();
        foreach($genreIds as $id){
            $fetchedGenre = $this->genreDao->getGenreById($id);
            array_push($genreNames, $fetchedGenre['name']);
        }
        $content['genres'] = $genreNames;

        return $content;
    }
    public function getContentRating($content)
    {
        $ratings = $this->ratingDao->getRatingByContentId($content['id']);
        $sum = 0;   
        foreach($ratings as $rating){
            $sum += doubleval($rating['rating_value']);
        }
        if(count($ratings) > 0) return $sum / count($ratings);
        return count($ratings);
    }
    public function getContentReviews($content)
    {
        $ratings = $this->ratingDao->getRatingByContentId($content['id']);
        $comments = array();
        foreach($ratings as $rating){
            array_push($comments, ["username" => $rating['user_id'], "comment" => $rating['comment'], "rating" => $rating['rating_value']]);
        }
        
        return $comments;
    }
}