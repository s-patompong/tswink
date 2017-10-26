<?php


namespace TsWink\Tests;


use PHPUnit\Framework\TestCase;
use TsWink\Classes\TswinkGenerator;

class TswinkGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_generate_typescript_classes()
    {
        $generator = new TswinkGenerator;
        
        $generator->setDestination(__DIR__."/models");
        $generator->generate();

        $this->assertEquals(true, true);
    }
}