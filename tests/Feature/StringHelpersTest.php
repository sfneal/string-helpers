<?php

namespace Sfneal\Helpers\Strings\Tests\Feature;

use PHPUnit\Framework\TestCase;
use Sfneal\Helpers\Strings\StringHelpers;

class StringHelpersTest extends TestCase
{
    // todo: improve test assertions

    /** @test */
    public function sanitizeFileName()
    {
        $string = (new StringHelpers('random.string.name'))->sanitizeFileName();

        $this->assertStringNotContainsString('.', $string);
        $this->assertStringContainsString('_', $string);
    }

    /** @test */
    public function truncate()
    {
        $string = (new StringHelpers(randomPassword(20)))->truncate(10, '');

        $this->assertEquals(10, strlen($string));
    }

    /** @test */
    public function camelCaseConvert()
    {
        $expected = 'camel-case-string';
        $string = (new StringHelpers('camelCaseString'))->camelCaseConvert();

        $this->assertStringContainsString('-', $string);
        $this->assertEquals($expected, $string);
    }

    /** @test */
    public function camelCaseSplit()
    {
        $expected = ['Camel', 'Case', 'String'];
        $array = (new StringHelpers('CamelCaseString'))->camelCaseSplit();

        $this->assertIsArray($array);
        $this->assertEquals($expected, $array);
    }

    /** @test */
    public function id()
    {
        $string = (new StringHelpers('illegal id & string'))->id();

        $this->assertStringNotContainsString('&', $string);
        $this->assertStringNotContainsString(' ', $string);
    }

    /** @test */
    public function strip()
    {
        $string = (new StringHelpers('illegal-id & string'))->strip();

        $this->assertStringNotContainsString('&', $string);
        $this->assertStringNotContainsString(' ', $string);
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
        $this->assertCount(3, $listString);
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
        $this->assertEquals(strlen($paddedString), strlen($string) + $amount * 2);
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
        $this->assertEquals(strlen($paddedString), strlen($string) + $amount);
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
        $this->assertEquals(strlen($paddedString), strlen($string) + $amount);
    }

    /** @test  */
    public function whitespaceRemove()
    {
        // String to remove whitespace from
        $string = 'here is a string with whitespace';

        // String without whitespace
        $noWhitespace = (new StringHelpers($string))->whitespaceRemove();

        // Confirm whitespace is removed
        $this->assertStringNotContainsString(' ', $noWhitespace);

        // Confirm string is as expected
        $this->assertEquals('hereisastringwithwhitespace', $noWhitespace);
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
        $this->assertStringContainsString('-', $noWhitespace);

        // Confirm string is as expected
        $this->assertEquals('here-is-a-string-with-whitespace', $noWhitespace);
    }

    /** @test  */
    public function fill()
    {
        // String to fill
        $string = 'key';

        // Length of the filled string
        $length = 10;

        // Character used to fill whitespace
        $filler = ' ';

        // Fill the string with whitespace
        $filled = (new StringHelpers($string))->fill($length, $filler);

        // Confirm string length is correct
        $this->assertEquals($length, strlen($filled));

        // Confirm correct number of $filler chars
        $this->assertEquals($length - strlen($string), substr_count($filled, $filler));
    }
}
