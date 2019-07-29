<?php

namespace NZTim\CommandBus\Mapping;

class MapItem
{
    private $handlerClass;
    private $handlerMethod;

    public function __construct(string $handlerClass, string $handlerMethod = '__invoke')
    {
        $this->handlerClass = $handlerClass;
        $this->handlerMethod = $handlerMethod;
    }

    public function handlerClass(): string
    {
        return $this->handlerClass;
    }

    public function handlerMethod(): string
    {
        return $this->handlerMethod;
    }
}
