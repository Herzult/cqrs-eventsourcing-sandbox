<?php

namespace EventSourcing;

class EventStream implements \IteratorAggregate
{
    /**
     * @var Event[]
     */
    private $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }
}
