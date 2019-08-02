<?php

namespace NZTim\CommandBus\Laravel;

use NZTim\CommandBus\CommandBus;
use NZTim\Queue\Job;

abstract class QueuedCommand implements Job
{
    public function handle()
    {
        app(CommandBus::class)->handle($this);
    }
}
