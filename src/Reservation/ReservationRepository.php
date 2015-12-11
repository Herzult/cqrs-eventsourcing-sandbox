<?php

namespace Reservation;

use EventSourcing\EventSourcedRepository;

class ReservationRepository extends EventSourcedRepository
{
    protected function createAggregateRootInstance()
    {
        return new Reservation();
    }
}
