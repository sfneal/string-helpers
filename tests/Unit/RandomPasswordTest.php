<?php

namespace Sfneal\Helpers\Strings\Tests\Unit;

use Sfneal\Helpers\Strings\Tests\TestCase;

class RandomPasswordTest extends TestCase
{
    /** @test */
    public function random_password_is_8_chars()
    {
        $string = randomPassword();

        $this->assertIsString($string);
        $this->assertTrue(strlen($string) == 8);
    }
}
