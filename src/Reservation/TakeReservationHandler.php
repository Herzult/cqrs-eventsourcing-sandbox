<?php

namespace Reservation;

use Cqrs\CommandHandler;
use Cqrs\Command;

class TakeReservationHandler implements CommandHandler
{
    private $repository;

    public function __construct(ReservationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Command $command)
    {
        $reservation = Reservation::take(
            $command->reservationId,
            $command->restaurantId,
            $command->customerId,
            $command->numPeople,
            $command->dateTime
        );

        $this->repository->save($reservation);
    }
}
