<?php

use Slim\Views\Mustache;
use PHPUnit\Framework\TestCase;

class MustacheFactoryTest extends TestCase
{
    private $view;

    public function setUp(): void
    {
        $this->view = new Mustache([]);
    }

    public function testRender()
    {
        $mockBody = $this->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockResponse = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockBody->expects($this->once())
            ->method('write')
            ->with("Test data, TEST\n")
            ->willReturn(17);

        $mockResponse->expects($this->once())
            ->method('getBody')
            ->willReturn($mockBody);

        $response = $this->view->render($mockResponse
            , "Test data, {{ test }}\n"
            , ['test' => 'TEST']);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
    }
}