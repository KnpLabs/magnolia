<?php

declare(strict_types=1);

namespace Domain;

use Domain\Model\GenericEvent;
use Domain\Model\RawEvent;
use Ramsey\Uuid\Uuid;

class RawEventTransformer
{
    public function transform(RawEvent $rawEvent): GenericEvent
    {
        if (empty($rawEvent->getPayload())) {
            throw new \InvalidArgumentException('Unable to transform the event: no payload found.');
        }

        return new GenericEvent(
            Uuid::uuid4()->toString(),
            $rawEvent->getPayload()['type'],
            $rawEvent->getRepository(),
            $rawEvent->getDate()
        );
    }
}
