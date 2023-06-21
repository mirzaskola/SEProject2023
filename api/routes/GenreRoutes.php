<?php

use Services\GenreService;
use Models\Genre;

Flight::route('GET /genre', function(){
    $genreService = new GenreService();
    $data = $genreService->getAllGenre();
    Flight::json($data);
});

Flight::route('GET /genre/@id', function($id){
    $genreService = new GenreService();
    $response = $genreService->getGenreById($id);
    Flight::json($response);
});

Flight::route('POST /genre', function(){
    $genreService = new GenreService();
    $insertData = Flight::request()->data->insertData;

    $newGenre = new Genre();
    $newGenre->setName($insertData['name']);

    $genreService->insertGenre($newGenre);
    Flight::json($insertData);
});

Flight::route('PUT /genre', function(){
    $genreService = new GenreService();
    $insertData = Flight::request()->data->insertData;

    $newGenre = new Genre();
    $newGenre->setId($insertData['id']);
    $newGenre->setName($insertData['name']);

    $genreService->updateGenre($newGenre);
    Flight::json($insertData);
});

Flight::route('DELETE /genre', function(){
    $genreService = new GenreService();
    $insertData = Flight::request()->data->insertData;

    $newGenre = new Genre();    
    $newGenre->setId($insertData['id']);
    $newGenre->setName($insertData['name']);

    $genreService->deleteGenre($newGenre);
    Flight::json($insertData);
});

?>