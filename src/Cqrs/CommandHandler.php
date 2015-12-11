<?php

namespace Cqrs;

interface CommandHandler
{
    public function handle(Command $command);
}
