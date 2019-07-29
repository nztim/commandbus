<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MissingDefaultCommandHandler
{
    public function execute(DefaultCommand $command): string
    {
        return $command->val();
    }
}
