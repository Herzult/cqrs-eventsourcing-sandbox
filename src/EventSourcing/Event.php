<?php

namespace EventSourcing;

interface Event
{
    public function getAggregateRootId();
}
