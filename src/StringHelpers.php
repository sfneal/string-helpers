<?php

namespace Sfneal\Helpers\Strings;

class StringHelpers
{
    /**
     * @var string
     */
    private $string;

    /**
     * StringHelpers constructor.
     *
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * Sanitize a file name to remove illegal chars.
     *
     * @return string
     */
    public function sanitizeFileName(): string
    {
        return preg_replace('/[^A-Za-z0-9_\-]/', '_', $this->string);
    }

    /**
     * Truncate a string to be no longer than $chars.
     *
     * @param int $chars
     * @param string $suffix
     * @return string
     */
    public function truncate(int $chars = 100, string $suffix = '...'): string
    {
        return (strlen($this->string) <= $chars) ? $this->string : substr($this->string, 0, $chars).$suffix;
    }

    /**
     * Covert a camel cased string into a $char separated string.
     *
     * @param string $char
     * @return string
     */
    public function camelCaseConvert(string $char = '-'): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', $char.'$0', $this->string));
    }

    /**
     * Remove illegal characters from a string to create an ID.
     *
     *  - legal chars: '&', ' '
     *
     * @return string
     */
    public function id(): string
    {
        // todo: improve this by removing repeated '-'
        return strtolower(
            str_replace(' ', '-', str_replace('&', '-', $this->string))
        );
    }

    /**
     * Remove ' ', '-', '&' characters.
     *
     * @return string
     */
    public function strip(): string
    {
        // todo: maybe replace with id & make depreciated?
        return strtolower(
            str_replace(
                ',', '', str_replace(
                    ' ', '-', str_replace(
                        '&',
                        '',
                        $this->string
                    )
                )
            )
        );
    }

    /**
     * Check if a needle string is in a haystack string.
     *
     * @param string|array $needle
     * @param string $boolean
     * @return bool
     */
    public function inString($needle, string $boolean = 'and'): bool
    {
        // Determine if an array of $needle's was passed
        if (is_array($needle)) {

            // Check if each of the needles is found in the haystack
            $results = [];
            foreach ($needle as $need) {
                $results[] = $this->isNeedleInString($need);
            }

            // Determine if any of the needles can exist to return true
            if ($boolean == 'or') {
                return in_array(true, $results);
            }

            // All needles must be found
            else {
                return arrayValuesEqual($results, true);
            }
        }

        return $this->isNeedleInString($needle);
    }

    /**
     * Check if a needle exists inside a haystack.
     *
     * @param $needle
     * @return bool
     */
    private function isNeedleInString($needle): bool
    {
        return strpos($this->string, $needle) !== false;
    }

    /**
     * Determine if the $string is a plain text list of values.
     *
     *  - if $string is a list, an array of values is returned
     *  - if $sting is a string, false is returned
     *
     * @param array|string[] $separators
     * @return bool|false|string[]
     */
    public function isListString(array $separators = [', ', ' '])
    {
        foreach ($separators as $needle) {
            // If the $needle is found in the $string
            // we know the string is a plain text list
            // so an array of values is returned
            if ($this->inString($needle)) {
                return explode($needle, $this->string);
            }
        }

        // If none of the separators are found
        // we know the string is not a list
        return false;
    }

    /**
     * Explode a string using an array of delimiters instead of a single string.
     *
     * @param array|string[] $delimiters
     * @param string $replacer
     * @return array
     */
    public function explodeMany(array $delimiters = [',', '&', '/', '-'], string $replacer = '***'): array
    {
        // Replace all of $delimiters chars with the
        // $replacer so that a single delimiter can
        // be used to explode the string
        $cleaned = str_replace($delimiters, $replacer, $this->string);

        // Use the replacer as the $delimiter
        // since it has replaced each of the
        // passed $delimiters
        $split = explode($replacer, $cleaned);

        // Utilize collection's if laravel/framework is installed
        if (function_exists('collect')) {
            // Collect the array of strings
            return collect($split)

                // Remove empty strings from the collection
                ->filter(function (string $item) {
                    return strlen($item) > 0;
                })

                // Trim the remaining strings in the collection
                ->map(function (string $item) {
                    return trim($item);
                })

                // Encode as array
                ->toArray();
        }

        // Use built in array functions
        else {
            // Remove empty strings from the collection
            $filtered = array_filter($split, function (string $item) {
                return strlen($item) > 0;
            });

            // Trim the remaining strings in the collection
            return  array_map(function (string $item) {
                return trim($item);
            }, $filtered);
        }
    }

    /**
     * Add whitespace padding to a string.
     *
     * @param int $amount
     * @param string $pad
     * @param bool $front add whitespace to 'front' of the string
     * @param bool $back add whitespace to the 'back' of the string
     * @return string
     */
    public function whitespacePad(int $amount = 1,
                                  string $pad = ' ',
                                  bool $front = true,
                                  bool $back = true): string
    {
        // Multiple $pad chars by $amount
        $whitespace = str_repeat($pad, $amount);

        // Return string with padding
        return ($front ? $whitespace : '').$this->string.($back ? $whitespace : '');
    }

    /**
     * Add whitespace padding to only the 'back' of the string.
     *
     * @param int $amount
     * @param string $pad
     * @return string
     */
    public function whitespacePadBack(int $amount = 1, string $pad = ' '): string
    {
        return $this->whitespacePad($amount, $pad, false, true);
    }

    /**
     * Add whitespace padding to only the 'back' of the string.
     *
     * @param int $amount
     * @param string $pad
     * @return string
     */
    public function whitespacePadFront(int $amount = 1, string $pad = ' '): string
    {
        return $this->whitespacePad($amount, $pad, true, false);
    }
}
