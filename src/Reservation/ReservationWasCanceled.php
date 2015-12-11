<?php

namespace Reservation;

use EventSourcing\AbstractEvent;

final class ReservationWasCanceled extends AbstractEvent
{
    public $reservationId;

    public function getAggregateRootId()
    {
        return $this->reservationId;
    }
}
