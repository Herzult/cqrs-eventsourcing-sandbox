<?php

namespace Reservation;

use Cqrs\AbstractCommand;

final class TakeReservation extends AbstractCommand
{
    public $reservationId;
    public $restaurantId;
    public $customerId;
    public $numPeople;
    public $dateTime;
}
