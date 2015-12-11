<?php

namespace EventSourcing;

interface AggregateRoot
{
    public function getAggregateRootId();

    public function getUncommittedEvents();

    public function loadFromEventStream(EventStream $events);
}
