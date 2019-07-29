<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MissingMethodCommandHandler
{
    public function execute(MethodCommand $command): string
    {
        return $command->val();
    }
}
