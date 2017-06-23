<?php

declare(strict_types=1);

namespace UseCases\ReadFeeds;

use Domain\Model;
use UseCases\CanHaveErrors;

class Response
{
    use CanHaveErrors;

    /** @var Model\Feed[] */
    private $feeds;

    private function __construct(array $feeds, array $errors)
    {
        $this->feeds = $feeds;
        $this->errors = $errors;
    }

    public static function succeeded(array $feeds): self
    {
        return new self($feeds, []);
    }

    public static function failed(array $errors): self
    {
        return new self([], $errors);
    }

    public function getFeeds()
    {
        return $this->feeds;
    }
}
