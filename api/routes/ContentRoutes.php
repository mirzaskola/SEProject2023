<?php

use Models\SearchRequest;
use Services\ContentService;
use Models\Content;

Flight::route('GET /content/toprated', function(){
    $contentService = new ContentService();
    $data = $contentService->getAllContent();
    Flight::json($data);
});
Flight::route('GET /content/@id', function($id){
    $contentService = new ContentService();
    $response = $contentService->getContentById($id);
    Flight::json($response);
});
Flight::route('GET /content/type/@type', function($type){
    $contentService = new ContentService();
    $data = $contentService->getContentByType($type);
    Flight::json($data);
});
Flight::route('POST /content', function(){
    $contentService = new ContentService();
    $insertData = Flight::request()->data->insertData;
    $newContent = new Content();

    $newContent->setTitle($insertData['title']);
    $newContent->setDescription($insertData['description']);
    $newContent->setReleaseDate($insertData['release_date']);
    $newContent->setDuration($insertData['duration']);
    $newContent->setGenres($insertData['genres']);
    $newContent->setCoverImage($insertData['cover_image']);
    $newContent->setContentTypeId($insertData['content_type_id']);

    $contentService->insertContent($newContent);
    Flight::json($insertData);
});
Flight::route('PUT /content', function(){
    $contentService = new ContentService();
    $insertData = Flight::request()->data->insertData;
    $newContent = new Content();

    $newContent->setTitle($insertData['title']);
    $newContent->setDescription($insertData['description']);
    $newContent->setReleaseDate($insertData['release_date']);
    $newContent->setDuration($insertData['duration']);
    $newContent->setGenres($insertData['genres']);
    $newContent->setCoverImage($insertData['cover_image']);
    $newContent->setContentTypeId($insertData['content_type_id']);

    $contentService->updateContent($newContent);
    Flight::json($insertData);
});
Flight::route('DELETE /content', function(){
    $contentService = new ContentService();
    $insertData = Flight::request()->data->insertData;
    $newContent = new Content();

    $newContent->setTitle($insertData['title']);
    $newContent->setDescription($insertData['description']);
    $newContent->setReleaseDate($insertData['release_date']);
    $newContent->setDuration($insertData['duration']);
    $newContent->setGenres($insertData['genres']);
    $newContent->setCoverImage($insertData['cover_image']);
    $newContent->setContentTypeId($insertData['content_type_id']);

    $contentService->deleteContent($newContent);
    Flight::json($insertData);
});
Flight::route('POST /content/search', function(){
    $contentService = new ContentService();
    $data = Flight::request()->data->getData();

    $newSearch = new SearchRequest();
    $newSearch->setSearchInput($data['searchInput']);
    $newSearch->setContentType($data['contentType']);

    $data = $contentService->getContentBySearch($newSearch);
    Flight::json($data);
});
?>