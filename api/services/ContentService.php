<?php

namespace Services;

use Dao\ContentDao;
use Dao\GenreDao;
use Models\Content;
use Models\SearchRequest;

class ContentService{ 
    public $contentDao;
    public $genreDao;

    public function __construct(){
        $this->contentDao = new ContentDao();
        $this->genreDao = new GenreDao();
    }
    public function getAllContent(){
        return $this->contentDao->getAllContent();
    }
    public function getContentById($id){
        $content = $this->contentDao->getContentById(intval($id));
        $brackets = array('[', ']', ',');
        $genreIds = str_replace($brackets, "", $content['genres']);
        $genreStringIds = explode(" ", $genreIds);
        $genreNames = array();
        foreach($genreStringIds as $id){
            $fetchedGenre = $this->genreDao->getGenreById(intval($id));
            array_push($genreNames, $fetchedGenre['name']);
        }
        $content['genres'] = $genreNames;
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