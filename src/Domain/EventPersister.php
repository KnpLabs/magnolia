<?php

namespace Domain;

interface EventPersister
{
    public function save(Model\GenericEvent $event);
}
