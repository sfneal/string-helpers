<?php


namespace Sfneal\Helpers\Strings\Tests;


use PHPUnit\Framework\TestCase;

class StaticHelpersTest extends TestCase
{
    /** @test */
    public function implodeFiltered()
    {
        $expected = 'Boston, MA';
        $output = implodeFiltered(', ', ['Boston', 'MA']);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);

        $expected2 = 'Red-Blue-Green-Yellow';
        $output2 = implodeFiltered('-', ['Red', 'Blue', null, 'Green', null, 'Yellow']);
        $this->assertIsString($output2);
        $this->assertEquals($expected2, $output2);
    }

    /** @test */
    public function joinPaths()
    {
        $expected = 'home/user/docs/document.pdf';
        $output = joinPaths('home', 'user', 'docs', 'document.pdf');
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function extractWebsiteDomain()
    {
        $url = 'https://superuser.com/questions/385653/batch-producing-pdfs-from-a-sequence-of-urls-multiple-urls';
        $expected = 'superuser.com';
        $output = extractWebsiteDomain($url);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function zero_replace()
    {
        $this->assertEquals('-', zero_replace(0));
        $this->assertEquals(1021, zero_replace(1021));
        $this->assertEquals('*', zero_replace(0, '*'));
        $this->assertEquals(546, zero_replace(546, '*'));
        $this->assertEquals('blank', zero_replace(546, '-', 'blank'));
    }

    /** @test */
    public function implodePretty()
    {
        $expected = 'First, Second & Third';
        $output = implodePretty(['First', 'Second', 'Third']);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);

        $expected = 'First & Second';
        $output = implodePretty(['First', 'Second']);
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);

        $expected = 'First; Second + Third';
        $output = implodePretty(['First', 'Second', 'Third'], ';', '+');
        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
