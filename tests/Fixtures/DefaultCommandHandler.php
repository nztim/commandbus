<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class DefaultCommandHandler
{
    public function handle(DefaultCommand $command): string
    {
        return $command->val();
    }
}
