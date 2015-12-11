<?php

namespace Cqrs;

abstract class AbstractCommand implements Command
{
    public function __construct(array $values = array())
    {
        foreach ($values as $property => $value) {
            $this->{$property} = $value;
        }
    }
}
