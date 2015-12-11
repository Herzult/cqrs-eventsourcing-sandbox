<?php

namespace Reservation;

use EventSourcing\AbstractEvent;

final class ReservationWasTaken extends AbstractEvent
{
    public $reservationId;
    public $restaurantId;
    public $customerId;
    public $numPeople;
    public $dateTime;

    public function getAggregateRootId()
    {
        return $this->reservationId;
    }
}
