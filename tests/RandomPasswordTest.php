<?php

namespace Sfneal\Helpers\Strings\Tests;

use PHPUnit\Framework\TestCase;

class RandomPasswordTest extends TestCase
{
    /** @test */
    public function random_password_is_8_chars()
    {
        $string = random_password();

        $this->assertTrue(strlen($string) == 8);
    }
}
