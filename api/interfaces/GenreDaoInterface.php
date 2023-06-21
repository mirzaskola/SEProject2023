<?php

namespace Interfaces;

use Models\Genre;

interface GenreDaoInterface
{
    public function getAllGenre();
    public function getGenreById($id);
    public function insertGenre(Genre $genre);
    public function updateGenre(Genre $genre);
    public function deleteGenre(Genre $genre);
}
