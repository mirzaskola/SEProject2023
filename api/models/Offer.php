<?php

namespace Models;

class Offer
{
    private $id;
    private $partnerName;
    private $description;
    private $code;
    private $isActive;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPartnerName(): string
    {
        return $this->partnerName;
    }

    public function setPartnerName(string $partnerName): void
    {
        $this->partnerName = $partnerName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }
}
