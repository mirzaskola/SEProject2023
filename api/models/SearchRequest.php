<?php

namespace Models;

class SearchRequest
{
    private $searchInput;
    private $contentType;

    public function getSearchInput(): string
    {
        return $this->searchInput;
    }
    public function setSearchInput($searchInput): void
    {
        $this->searchInput = $searchInput;
    }
    public function getContentType(): int
    {
        return $this->contentType;
    }

    public function setContentType(int $contentType): void
    {
        $this->contentType = $contentType;
    }
}
