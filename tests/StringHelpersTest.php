<?php

namespace Sfneal\Helpers\Strings\Tests;

use PHPUnit\Framework\TestCase;
use Sfneal\Helpers\Strings\StringHelpers;

class StringHelpersTest extends TestCase
{
    /** @test */
    public function sanitizeFileName()
    {
        $string = (new StringHelpers('random.string.name'))->sanitizeFileName();

        $this->assertTrue(!inString($string, '.'));
        $this->assertTrue(inString($string, '_'));
    }

    /** @test */
    public function truncate()
    {
        $string = (new StringHelpers(randomPassword(20)))->truncate(10, '');

        $this->assertTrue(strlen($string) == 10);
    }

    /** @test */
    public function camelCaseConvert()
    {
        $string = (new StringHelpers('camelCaseString'))->camelCaseConvert();

        $this->assertTrue(inString($string, '-'));
    }

    /** @test */
    public function id()
    {
        $string = (new StringHelpers('illegal id & string'))->id();

        $this->assertTrue(! inString($string, '&'));
        $this->assertTrue(! inString($string, ' '));
    }

    /** @test */
    public function strip()
    {
        $string = (new StringHelpers('illegal-id & string'))->strip();

        $this->assertTrue(! inString($string, '&'));
        $this->assertTrue(! inString($string, ' '));
    }

    /** @test */
    public function inString()
    {
        // Find needle in haystack
        $inString = (new StringHelpers('haystack with a needle'))->inString('needle');
        $this->assertTrue($inString);

        // Needle can't be found
        $notInString = (new StringHelpers('haystack with a needle'))->inString('tom');
        $this->assertFalse($notInString);

        // Find ALL of an array of needles
        $inArray = (new StringHelpers('haystack with a needle'))->inString(['haystack', 'needle']);
        $this->assertTrue($inArray);

        // Find ANY of an array of needles
        $inArray = (new StringHelpers('haystack with a needle'))->inString(['john', 'needle'], 'or');
        $this->assertTrue($inArray);
    }
}