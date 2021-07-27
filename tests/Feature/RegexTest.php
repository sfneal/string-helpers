<?php


namespace Sfneal\Helpers\Strings\Tests\Feature;


use Sfneal\Helpers\Strings\Tests\TestCase;
use Sfneal\Helpers\Strings\Utils\Regex;

class RegexTest extends TestCase
{
    /** @test */
    public function ONLY_LETTERS()
    {
        $expected = '/[A-Z]/ig';
        $actual = Regex::ONLY_LETTERS;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function NOT_LETTERS()
    {
        $expected = '/[^A-Z]/ig';
        $actual = Regex::NOT_LETTERS;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function ONLY_NUMBERS()
    {
        $expected = '/[0-9]/g';
        $actual = Regex::ONLY_NUMBERS;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function NOT_NUMBERS()
    {
        $expected = '/[^0-9]/g';
        $actual = Regex::NOT_NUMBERS;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function NOT_NUMBERS_OR_LETTERS()
    {
        $expected = '/[^A-Z0-9]/ig';
        $actual = Regex::NOT_NUMBERS_OR_LETTERS;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function NOT_NUMBERS_OR_LETTERS_OR_UNDERSCORE()
    {
        $expected = '\W';
        $actual = Regex::NOT_NUMBERS_OR_LETTERS_OR_UNDERSCORE;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }
}
