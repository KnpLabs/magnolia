<?php

namespace Domain;

interface RawEventPersister
{
    public function saveMany(array $events);
}
