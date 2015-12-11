<?php

namespace EventSourcing;

interface EventStore
{
    public function load(AggregateRootId $id);

    public function append(AggregateRootId $id, EventStream $events);
}
