<?php

namespace Domain;

interface RawEventRepository
{
    public function find(string $owner, string $name): array;
}
