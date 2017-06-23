<?php

namespace Domain;

interface EventPersister
{
    public function saveMany(array $events);
}
