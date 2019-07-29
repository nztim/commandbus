<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class InvokeCommandHandler
{
    public function __invoke(InvokeCommand $command)
    {
        return $command->val();
    }
}
