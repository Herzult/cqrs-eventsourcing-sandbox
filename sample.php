<?php

require_once __DIR__.'/vendor/autoload.php';

$eventStore = new EventSourcing\InMemoryEventStore;
$eventBus = new EventSourcing\EventBus;
$eventBus->addListener(new Reservation\ReservationLogger);

$reservationRepository = new Reservation\ReservationRepository($eventStore, $eventBus);

$takeReservationHandler = new Reservation\TakeReservationHandler($reservationRepository);

$cancelReservationHandler = new Reservation\CancelReservationHandler($reservationRepository);

$cb = new Cqrs\CommandBus();
$cb->registerHandler(Reservation\TakeReservation::CLASS, $takeReservationHandler);
$cb->registerHandler(Reservation\CancelReservation::CLASS, $cancelReservationHandler);


$reservationId = Reservation\ReservationId::generate();

$cb->dispatch(new Reservation\TakeReservation([
    'reservationId' => $reservationId,
    'restaurantId'  => Reservation\RestaurantId::fromString('50e066a8-3af5-491b-8f7d-07196691b64b'),
    'customerId'    => Reservation\CustomerId::fromString('a561ea40-cdb3-420d-a1ef-9a9c13ebe728'),
    'numPeople'     => 4,
    'dateTime'      => new \DateTime('2016-10-10 12:30:00')
]));

$cb->dispatch(new Reservation\CancelReservation([
    'reservationId' => $reservationId
]));
