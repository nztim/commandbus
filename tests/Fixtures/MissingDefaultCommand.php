<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MissingDefaultCommand
{
    public function val(): string
    {
        return 'missing invoke!';
    }
}
