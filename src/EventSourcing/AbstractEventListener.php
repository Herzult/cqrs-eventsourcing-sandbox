<?php

namespace EventSourcing;

abstract class AbstractEventListener implements EventListener
{
    public function handle(Event $event)
    {
        $method = sprintf('handle%s', basename(str_replace('\\', '/', get_class($event))));

        if (method_exists($this, $method)) {
            $this->$method($event);
        }
    }
}
