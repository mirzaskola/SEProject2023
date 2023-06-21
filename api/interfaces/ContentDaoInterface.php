<?php

namespace Interfaces;

use Models\Content;
use Models\SearchRequest;

interface ContentDaoInterface
{
    
    public function getAllContent();
    public function getContentById($id);
    public function getContentByType($content_type);
    public function insertContent(Content $content);
    public function updateContent(Content $content);
    public function deleteContent(Content $content);
    public function getContentBySearch(SearchRequest $request);
}
