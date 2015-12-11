<?php

namespace Cqrs;

class CommandBus
{
    private $handlers;

    public function registerHandler($commandClass, CommandHandler $handler)
    {
        $this->handlers[$commandClass] = $handler;
    }

    public function dispatch(Command $command)
    {
        $handler = $this->handlers[get_class($command)];

        if (null === $handler) {
            throw new RuntimeException(sprintf(
                'No command handler registered for command class "%s".',
                get_class($command)
            ));
        }

        $handler->handle($command);
    }
}
