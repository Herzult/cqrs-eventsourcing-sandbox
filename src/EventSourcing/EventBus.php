<?php

namespace EventSourcing;

class EventBus
{
    private $listeners = [];

    public function addListener(EventListener $listener)
    {
        $this->listeners[] = $listener;
    }

    public function dispatch(EventStream $events)
    {
        foreach ($events as $event) {
            foreach ($this->listeners as $listener) {
                $listener->handle($event);
            }
        }
    }
}
