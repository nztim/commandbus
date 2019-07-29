<?php

namespace NZTim\CommandBus\Middleware;

use NZTim\CommandBus\Mapping\MapByName;
use NZTim\CommandBus\Mapping\Mapping;
use NZTim\CommandBus\Middleware;
use Psr\Container\ContainerInterface;
use RuntimeException;

class CommandHandlerMiddleware implements Middleware
{
    /** @var ContainerInterface */
    private $container;
    /** @var Mapping */
    private $mapping;
    /** @var MapByName */
    private $mapByName;

    public function __construct(ContainerInterface $container, Mapping $mapping, MapByName $mapByName)
    {
        $this->container = $container;
        $this->mapping = $mapping;
        $this->mapByName = $mapByName;
    }

    public function execute(object $command, callable $next)
    {
        $commandClassName = get_class($command);
        $map = $this->mapping->map($commandClassName) ?: $this->mapByName->map($commandClassName);
        $handler = $this->container->get($map->handlerClass());
        if (!is_callable([$handler, $map->handlerMethod()])) {
            throw new RuntimeException('Cannot call ' . $map->handlerMethod() . ' on handler class ' . get_class($handler));
        }
        return $handler->{$map->handlerMethod()}($command);
    }
}
