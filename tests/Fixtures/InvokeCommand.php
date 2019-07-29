<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class InvokeCommand
{
    public function val(): string
    {
        return 'invoked!';
    }
}
