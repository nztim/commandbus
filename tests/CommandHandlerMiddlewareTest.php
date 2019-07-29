<?php namespace NZTim\CommandBus\Tests;

use LogicException;
use NZTim\CommandBus\Mapping\MapByName;
use NZTim\CommandBus\Mapping\MapItem;
use NZTim\CommandBus\Mapping\Mapping;
use NZTim\CommandBus\Middleware\CommandHandlerMiddleware;
use NZTim\CommandBus\Tests\Fixtures\InvokeCommand;
use NZTim\CommandBus\Tests\Fixtures\InvokeCommandHandler;
use NZTim\CommandBus\Tests\Fixtures\MethodCommand;
use NZTim\CommandBus\Tests\Fixtures\MethodCommandHandler;
use NZTim\CommandBus\Tests\Fixtures\MissingInvokeCommand;
use NZTim\CommandBus\Tests\Fixtures\MissingInvokeCommandHandler;
use NZTim\CommandBus\Tests\Fixtures\MissingMethodCommand;
use NZTim\CommandBus\Tests\Fixtures\MissingMethodCommandHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use RuntimeException;

class CommandHandlerMiddlewareTest extends TestCase
{
    /** @var CommandHandlerMiddleware */
    private $middleware;
    /** @var ContainerInterface&MockObject */
    private $container;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $mapping = new Mapping([
            MethodCommand::class        => new MapItem(MethodCommandHandler::class, 'handle'),
            MissingMethodCommand::class => new MapItem(MissingMethodCommandHandler::class, 'handle'),
        ]);
        $this->middleware = new CommandHandlerMiddleware($this->container, $mapping, new MapByName());
    }

    /** @test */
    public function invoke_handling_works()
    {
        $this->container->expects($this->once())->method('get')->with(InvokeCommandHandler::class)->willReturn(new InvokeCommandHandler());
        $command = new InvokeCommand();
        $this->assertEquals($command->val(), $this->middleware->execute($command, $this->mockNext()));
    }

    /** @test */
    public function map_handling_works()
    {
        $this->container->expects($this->once())->method('get')->with(MethodCommandHandler::class)->willReturn(new MethodCommandHandler());
        $command = new MethodCommand();
        $this->assertEquals($command->val(), $this->middleware->execute($command, $this->mockNext()));
    }

    /** @test */
    public function missing_method()
    {
        $this->expectException(RuntimeException::class);
        $this->container->expects($this->once())->method('get')->with(MissingMethodCommandHandler::class)->willReturn(new MissingMethodCommandHandler());
        $command = new MissingMethodCommand();
        $this->middleware->execute($command, $this->mockNext());
    }

    /** @test */
    public function missing_invoke()
    {
        $this->expectException(RuntimeException::class);
        $this->container->expects($this->once())->method('get')->with(MissingInvokeCommandHandler::class)->willReturn(new MissingInvokeCommandHandler());
        $command = new MissingInvokeCommand();
        $this->middleware->execute($command, $this->mockNext());
    }

    protected function mockNext(): callable
    {
        return static function (): void {
            throw new LogicException('Middleware fell through to next callable, this should not happen in the test.');
        };
    }
}
