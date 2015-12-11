<?php

namespace EventSourcing;

interface EventListener
{
    public function handle(Event $event);
}
