<?php

namespace Models;

class Content
{
    private $id;
    private $title;
    private $description;
    private $releaseDate;
    private $duration;
    private $genres;
    private $coverImage;
    private $contentTypeId;
    private $rating;

    public function getId(): int
    {
        return $this->id;
    }
    public function getRating(): string
    {
        return $this->rating;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }

    public function addGenre(string $genre): void
    {
        $this->genres[] = $genre;
    }

    public function getCoverImage(): string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): void
    {
        $this->coverImage = $coverImage;
    }

    public function getContentTypeId(): int
    {
        return $this->contentTypeId;
    }

    public function setContentTypeId(int $contentTypeId): void
    {
        $this->contentTypeId = $contentTypeId;
    }
}
