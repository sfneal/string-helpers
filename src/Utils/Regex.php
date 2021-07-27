<?php

namespace Sfneal\Helpers\Strings\Utils;

class Regex
{
    /**
     * @var string Match letters only
     */
    public const ONLY_LETTERS = '/[A-Z]/ig';

    /**
     * @var string Match anything not letters
     */
    public const NOT_LETTERS = '/[^A-Z]/ig';

    /**
     * @var string Match number only
     */
    public const ONLY_NUMBERS = '/[0-9]/g';

    /**
     * @var string Match anything not number
     */
    public const NOT_NUMBERS = '/[^0-9]/g';

    /**
     * @var string Match anything not number or letter
     */
    public const NOT_NUMBERS_OR_LETTERS = '/[^A-Z0-9]/ig';

    /**
     * @var string Match anything not letter, number, or an underscore
     */
    public const NOT_NUMBERS_OR_LETTERS_OR_UNDERSCORE = '\W';
}
