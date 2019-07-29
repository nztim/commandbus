<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class DefaultCommand
{
    public function val(): string
    {
        return 'default!';
    }
}
