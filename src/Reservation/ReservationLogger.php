<?php

namespace Reservation;

use EventSourcing\AbstractEventListener;

class ReservationLogger extends AbstractEventListener
{
    public function handleReservationWasTaken(ReservationWasTaken $event)
    {
        echo sprintf(
            'Reservation #%s was taken for %s people the %s',
            $event->reservationId,
            $event->numPeople,
            $event->dateTime->format('Y-m-d \a\t H:i:s')
        );
        echo PHP_EOL;
    }

    public function handleReservationWasCanceled(ReservationWasCanceled $event)
    {
        echo sprintf(
            'Reservation #%s was canceled',
            $event->reservationId
        );
        echo PHP_EOL;
    }
}
