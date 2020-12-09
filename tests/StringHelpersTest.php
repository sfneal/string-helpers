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

        $this->assertTrue(! inString($string, '.'));
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

    /** @test */
    public function isListString()
    {
        $listString = (new StringHelpers('tom, dick, harry'))->isListString();

        $this->assertTrue(is_array($listString));
        $this->assertTrue(count($listString) == 3);
    }

    /** @test */
    public function explodeMany()
    {
        $listString = (new StringHelpers('tom, dick & harry'))->explodeMany();

        $this->assertTrue(is_array($listString));
        $this->assertTrue(count($listString) == 3);
    }

    /** @test */
    public function whitespacePad()
    {
        // String to add padding to
        $string = 'padded string';

        // Amount of padding chars to add to string
        $amount = 10;

        // Add padding
        $paddedString = (new StringHelpers($string))->whitespacePad($amount);

        // Confirm string has been padded
        $this->assertTrue(strlen($string) + $amount * 2 == strlen($paddedString));
    }

    /** @test */
    public function whitespacePadBack()
    {
        // String to add padding to
        $string = 'padded string';

        // Amount of padding chars to add to string
        $amount = 10;

        // Add padding
        $paddedString = (new StringHelpers($string))->whitespacePadBack($amount);

        // Confirm string has been padded
        $this->assertTrue(strlen($string) + $amount == strlen($paddedString));
    }

    /** @test */
    public function whitespacePadFront()
    {
        // String to add padding to
        $string = 'padded string';

        // Amount of padding chars to add to string
        $amount = 10;

        // Add padding
        $paddedString = (new StringHelpers($string))->whitespacePadFront($amount);

        // Confirm string has been padded
        $this->assertTrue(strlen($string) + $amount == strlen($paddedString));
    }

    /** @test  */
    public function whitespaceRemove()
    {
        // String to remove whitespace from
        $string = 'here is a string with whitespace';

        // String without whitespace
        $noWhitespace = (new StringHelpers($string))->whitespaceRemove();

        // Confirm whitespace is removed
        $this->assertTrue(! inString($noWhitespace, ' '));

        // Confirm string is as expected
        $this->assertTrue($noWhitespace == 'hereisastringwithwhitespace');
    }

    /** @test  */
    public function whitespaceReplace()
    {
        // String to replace whitespace
        $string = 'here is a string with whitespace';

        // Replace spaces with '-'
        $replacementChar = '-';

        // String with whitespace replace
        $noWhitespace = (new StringHelpers($string))->whitespaceReplace($replacementChar);

        // Confirm whitespace is removed
        $this->assertTrue(inString($noWhitespace, '-'));

        // Confirm string is as expected
        $this->assertTrue($noWhitespace == 'here-is-a-string-with-whitespace');
    }
}
