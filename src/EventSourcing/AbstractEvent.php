<?php

namespace EventSourcing;

abstract class AbstractEvent implements Event
{
    public function __construct(array $values)
    {
        foreach ($values as $property => $value) {
            $this->{$property} = $value;
        }
    }
}
