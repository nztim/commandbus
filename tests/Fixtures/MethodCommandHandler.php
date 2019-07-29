<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MethodCommandHandler
{
    public function handle(MethodCommand $command): string
    {
        return $command->val();
    }
}
