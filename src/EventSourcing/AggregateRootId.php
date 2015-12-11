<?php

namespace EventSourcing;

interface AggregateRootId
{
    public function __toString();
}
