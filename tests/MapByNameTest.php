<?php namespace NZTim\CommandBus\Tests;

use NZTim\CommandBus\Mapping\MapByName;
use PHPUnit\Framework\TestCase;

class MapByNameTest extends TestCase
{
    /** @test */
    public function without_namespace()
    {
        $item = (new MapByName())->map('AddPost');
        $this->assertEquals('AddPostHandler', $item->handlerClass());
        $this->assertEquals('__invoke', $item->handlerMethod());
    }

    /** @test */
    public function with_namespace()
    {
        $item = (new MapByName())->map('MyNamespace\AddPost');
        $this->assertEquals('MyNamespace\AddPostHandler', $item->handlerClass());
        $this->assertEquals('__invoke', $item->handlerMethod());
    }
}
