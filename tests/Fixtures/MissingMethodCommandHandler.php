<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MissingMethodCommandHandler
{
    public function execute(DefaultCommand $command): string
    {
        return $command->val();
    }
}
