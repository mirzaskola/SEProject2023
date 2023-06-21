<?php

namespace Services;

use Builders\ContentBuilder;

use Dao\ContentDao;
use Dao\GenreDao;
use Models\Content;
use Models\SearchRequest;

class ContentService{ 
    public $contentDao;
    public $genreDao;
    public $contentBuilder;

    public function __construct(){
        $this->contentDao = new ContentDao();
        $this->genreDao = new GenreDao();
        $this->contentBuilder = new ContentBuilder();
    }
    public function getAllContent(){
        $allContent = $this->contentDao->getAllContent();
        $allContentWithRating = array();
        foreach($allContent as $content){
            $content['rating'] = $this->contentBuilder->getContentRating($content);
            array_push($allContentWithRating, $content);
        }
        
        return $allContentWithRating;
    }
    public function getContentById($id){
        $content = $this->contentDao->getContentById(intval($id));
        $genreIds = str_replace(',', "", $content['genres']);
        $content['genres'] = $genreIds; 
        $content = $this->contentBuilder->getContentGenre($content);        
        $content['comments'] = $this->contentBuilder->getContentReviews($content);
        return $content;
        
    }
    public function getContentByType($content_type){
        return $this->contentDao->getContentByType($content_type);
    }
    public function insertContent(Content $content)
    {
        return $this->contentDao->insertContent($content);
    }
    public function updateContent(Content $content)
    {
        return $this->contentDao->updateContent($content);
    }
    public function deleteContent(Content $content)
    {
        return $this->contentDao->deleteContent($content);
    }
    public function getContentBySearch(SearchRequest $request)
    {
        return $this->contentDao->getContentBySearch($request);
    }
}
?>