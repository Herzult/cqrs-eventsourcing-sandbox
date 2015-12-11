<?php

namespace EventSourcing;

abstract class EventSourcedRepository
{
    private $eventStore;
    private $eventBus;

    public function __construct(EventStore $eventStore, EventBus $eventBus)
    {
        $this->eventStore = $eventStore;
        $this->eventBus = $eventBus;
    }

    public function load(AggregateRootId $id)
    {
        $events = $this->eventStore->load($id);

        $ar = $this->createAggregateRootInstance();
        $ar->loadFromEventStream($events);

        return $ar;
    }

    public function save(AggregateRoot $ar)
    {
        $es = $ar->getUncommittedEvents();
        $this->eventStore->append($ar->getAggregateRootId(), $es);
        $this->eventBus->dispatch($es);
    }

    abstract protected function createAggregateRootInstance();
}
