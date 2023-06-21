<?php

namespace Services;

use Dao\GenreDao;
use Models\Genre;

class GenreService{ 
    public $genreDao;

    public function __construct()
    {
        $this->genreDao = new GenreDao();
    }
    public function getAllGenre()
    {
        return $this->genreDao->getAllGenre();
    }
    public function getGenreById($id)
    {
        return $this->genreDao->getGenreById($id);
    }
    public function insertGenre(Genre $genre)
    {
        return $this->genreDao->insertGenre($genre);
    }
    public function updateGenre(Genre $genre)
    {
        return $this->genreDao->updateGenre($genre);
    }
    public function deleteGenre(Genre $genre)
    {
        return $this->genreDao->deleteGenre($genre);
    }
}
?>