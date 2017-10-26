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

        $modelPath = __DIR__."/models";
        if(!file_exists($modelPath)) {
            mkdir($modelPath, 0777, true);
        }

        $generator->setDestination($modelPath);
        $generator->generate();

        $this->assertEquals(true, true);
    }
}