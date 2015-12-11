<?php

namespace EventSourcing;

use Ramsey\Uuid\Uuid;

abstract class UuidAggregateRootId implements AggregateRootId
{
    private $uuid;

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromString($string)
    {
        return new static(Uuid::fromString($string));
    }

    public static function generate()
    {
        return new static(Uuid::uuid4());
    }

    public function __toString()
    {
        return $this->uuid->toString();
    }
}
