<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MissingMethodCommand
{
    public function val(): string
    {
        return 'missing!';
    }
}
