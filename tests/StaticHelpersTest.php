<?php

namespace Sfneal\Helpers\Strings\Tests;

use PHPUnit\Framework\TestCase;
use Sfneal\Helpers\Strings\StringHelpers;

class StaticHelpersTest extends TestCase
{
    /** @test */
    public function implodeFiltered()
    {
        $expected = 'Boston, MA';
        $output = StringHelpers::implodeFiltered(', ', ['Boston', 'MA']);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);

        $expected2 = 'Red-Blue-Green-Yellow';
        $output2 = StringHelpers::implodeFiltered('-', ['Red', 'Blue', null, 'Green', null, 'Yellow']);
        $this->assertIsString($output2);
        $this->assertEquals($expected2, $output2);
    }

    /** @test */
    public function joinPaths()
    {
        $expected = 'home/user/docs/document.pdf';
        $output = StringHelpers::joinPaths('home', 'user', 'docs', 'document.pdf');
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function extractWebsiteDomain()
    {
        $url = 'https://superuser.com/questions/385653/batch-producing-pdfs-from-a-sequence-of-urls-multiple-urls';
        $expected = 'superuser.com';
        $output = StringHelpers::extractWebsiteDomain($url);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function extractEmailDomain()
    {
        $url = 'user@example.com';
        $expected = 'example.com';
        $output = StringHelpers::extractEmailDomain($url);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function zero_replace()
    {
        $this->assertEquals('-', StringHelpers::zeroReplace(0));
        $this->assertEquals(1021, StringHelpers::zeroReplace(1021));
        $this->assertEquals('*', StringHelpers::zeroReplace(0, '*'));
        $this->assertEquals(546, StringHelpers::zeroReplace(546, '*'));
        $this->assertEquals('blank', StringHelpers::zeroReplace(546, '-', 'blank'));
    }

    /** @test */
    public function implodePretty()
    {
        $expected = 'First, Second & Third';
        $output = StringHelpers::implodePretty(['First', 'Second', 'Third']);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);

        $expected = 'First & Second';
        $output = StringHelpers::implodePretty(['First', 'Second']);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);

        $expected = 'First; Second + Third';
        $output = StringHelpers::implodePretty(['First', 'Second', 'Third'], ';', '+');
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
