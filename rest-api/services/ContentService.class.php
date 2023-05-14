<?php

require_once __DIR__.'/../dao/ContentDao.class.php';


class ContentService{ 
    public $content_dao;

    public function __construct(){
        $this->content_dao = new ContentDao();
    }
    public function get_all_content(){
        return $this->content_dao->get_all_content();
    }
    public function get_content_by_id($content_id){
        return $this->content_dao->get_content_by_id($content_id);
    }
}
?>