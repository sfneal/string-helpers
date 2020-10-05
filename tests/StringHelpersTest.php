<?php

namespace Sfneal\Helpers\Strings\Tests;

use PHPUnit\Framework\TestCase;
use Sfneal\Helpers\Strings\StringHelpers;

class StringHelpersTest extends TestCase
{
    /** @test */
    public function sanitize_filename()
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
    public function camelCase()
    {
        $string = (new StringHelpers('camelCaseString'))->camelCaseConvert();

        $this->assertTrue(inString($string, '-'));
    }
}
