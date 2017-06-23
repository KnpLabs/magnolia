<?php

declare(strict_types=1);

namespace UseCases;

trait CanHaveErrors
{
    /** @var string[] */
    private $errors;

    public function isSuccessful(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
