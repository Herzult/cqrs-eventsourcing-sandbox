<?php

namespace EventSourcing;

abstract class AbstractAggregateRoot implements AggregateRoot
{
    private $uncomittedEvents = [];

    public function getUncommittedEvents()
    {
        $events = $this->uncomittedEvents;
        $this->uncomittedEvents = [];

        return new EventStream($events);
    }

    public function loadFromEventStream(EventStream $events)
    {
        foreach ($events as $event) {
            $this->applyEvent($event);
        }
    }

    public function recordThat(Event $event)
    {
        $this->applyEvent($event);
        $this->uncomittedEvents[] = $event;
    }

    private function applyEvent(Event $event)
    {
        $method = sprintf('apply%s', basename(str_replace('\\', '/', get_class($event))));

        if (!method_exists($this, $method)) {
            throw new \RuntimeException(sprintf(
                'No method found to apply event "%s".',
                get_class($event)
            ));
        }

        $this->$method($event);
    }
}
