<?php

namespace Services;

use Dao\ContentDao;
use Models\Content;

class ContentService{ 
    public $content_dao;

    public function __construct(){
        $this->content_dao = new ContentDao();
    }
    public function getAllContent(){
        return $this->content_dao->getAllContent();
    }
    public function getContentById($id){
        return $this->content_dao->getContentById($id);
    }
    public function getContentByType($content_type){
        return $this->content_dao->getContentByType($content_type);
    }
    public function insertContent(Content $content)
    {
        return $this->content_dao->insertContent($content);
    }
    public function updateContent(Content $content)
    {
        return $this->content_dao->updateContent($content);
    }
    public function deleteContent(Content $content)
    {
        return $this->content_dao->deleteContent($content);
    }
}
?>