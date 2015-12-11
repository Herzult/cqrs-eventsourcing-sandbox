<?php

namespace Reservation;

use EventSourcing\AbstractAggregateRoot;

class Reservation extends AbstractAggregateRoot
{
    private $reservationId;
    private $restaurantId;
    private $customerId;
    private $numPeople;
    private $dateTime;
    private $canceled;

    public function getAggregateRootId()
    {
        return $this->reservationId;
    }

    public static function take(
        ReservationId $reservationId,
        RestaurantId $restaurantId,
        CustomerId $customerId,
        $numPeople,
        \DateTime $dateTime
    ) {
        $reservation = new Reservation;
        $reservation->recordThat(new ReservationWasTaken([
            'reservationId' => $reservationId,
            'restaurantId'  => $restaurantId,
            'customerId'    => $customerId,
            'numPeople'     => $numPeople,
            'dateTime'      => $dateTime
        ]));

        return $reservation;
    }

    public function cancel()
    {
        if ($this->canceled) {
            return;
        }

        $this->recordThat(new ReservationWasCanceled(['reservationId' => $this->reservationId]));
    }

    public function applyReservationWasTaken(ReservationWasTaken $event)
    {
        $this->reservationId = $event->reservationId;
        $this->restaurantId = $event->restaurantId;
        $this->customerId = $event->customerId;
        $this->numPeople = $event->numPeople;
        $this->dateTime = $event->dateTime;
        $this->canceled = false;
    }

    protected function applyReservationWasCanceled(ReservationWasCanceled $event)
    {
        $this->canceled = true;
    }
}
