<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MissingInvokeCommandHandler
{
    public function execute(MethodCommand $command): string
    {
        return $command->val();
    }
}
