<?php

namespace Reservation;

use Cqrs\CommandHandler;
use Cqrs\Command;

class CancelReservationHandler implements CommandHandler
{
    private $repository;

    public function __construct(ReservationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Command $command)
    {
        $reservation = $this->repository->load($command->reservationId);
        $reservation->cancel();
        $this->repository->save($reservation);
    }
}
