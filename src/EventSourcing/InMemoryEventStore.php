<?php

namespace EventSourcing;

class InMemoryEventStore implements EventStore
{
    private $events;

    public function load(AggregateRootId $id)
    {
        return new EventStream($this->events[(string) $id]);
    }

    public function append(AggregateRootId $id, EventStream $events)
    {
        foreach ($events as $event) {
            $this->events[(string) $id][] = $event;
        }
    }
}
