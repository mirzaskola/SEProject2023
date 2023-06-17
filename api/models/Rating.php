<?php

namespace Models;

class Rating
{
    private $id;
    private $contentId;
    private $userId;
    private $ratingValue;
    private $comment;
    private $dateCreated;

    public function getId(): int
    {
        return $this->id;
    }

    public function getContentId(): int
    {
        return $this->contentId;
    }

    public function setContentId(int $contentId): void
    {
        $this->contentId = $contentId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getRatingValue(): float
    {
        return $this->ratingValue;
    }

    public function setRatingValue(float $ratingValue): void
    {
        $this->ratingValue = $ratingValue;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    public function setDateCreated(string $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }
}
