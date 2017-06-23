<?php

declare(strict_types=1);

namespace UseCases\CreateFeed;

use UseCases\CanHaveErrors;

class Response
{
    use CanHaveErrors;

    private $feedId;

    private function __construct(string $feedId = null, array $errors)
    {
        $this->feedId = $feedId;
        $this->errors = $errors;
    }

    public static function succeeded(string $feedId): self
    {
        return new self($feedId, []);
    }

    public static function failed(array $errors): self
    {
        return new self(null, $errors);
    }

    public function getFeedId(): string
    {
        return $this->feedId;
    }
}
