<?php

namespace Reservation;

use Cqrs\AbstractCommand;

final class CancelReservation extends AbstractCommand
{
    public $reservationId;
}
