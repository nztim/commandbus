<?php

namespace NZTim\CommandBus\Tests\Fixtures;

class MissingInvokeCommand
{
    public function val(): string
    {
        return 'missing invoke!';
    }
}
