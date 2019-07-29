<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MethodCommand
{
    public function val(): string
    {
        return 'handled!';
    }
}
