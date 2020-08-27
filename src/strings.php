<?php

/**
 * Sanitize a file name to remove illegal chars.
 *
 * @param string $raw
 * @return string
 */
function sanitizeFileName(string $raw): string
{
    return preg_replace('/[^A-Za-z0-9_\-]/', '_', $raw);
}

/**
 * Truncate a string to be no longer than $chars.
 *
 * @param string $string
 * @param int $chars
 * @param string $suffix
 * @return string
 */
function truncateString(string $string, int $chars = 100, string $suffix = '...'): string
{
    return (strlen($string) <= $chars) ? $string : substr($string, 0, $chars).$suffix;
}

/**
 * Covert a camel cased string into a $char separated string.
 *
 * @param string $string
 * @param string $char
 * @return string
 */
function camelCaseConverter(string $string, $char = '-'): string
{
    return strtolower(preg_replace('/(?<!^)[A-Z]/', $char.'$0', $string));
}

/**
 * Implode values that are not null.
 *
 * @param $glue
 * @param array $pieces
 * @return string|null
 */
function implodeFiltered($glue, array $pieces)
{
    if (! empty($pieces) && count($pieces) > 0) {
        return implode($glue, array_filter($pieces, function ($attr) {
            return isset($attr);
        }));
    } else {
        return null;
    }
}

/**
 * Retrieve a website domain without prefixes.
 *
 * @param string $url
 * @return string
 */
function extractWebsiteDomain(string $url)
{
    return isset($url) ? str_replace('www.', '', parse_url($url)['host']) : '';
}

/**
 * Only retrieve an integer value if the $value is greater than zero.
 *
 * Uses $return as the $return value instead of $value if not null.
 * Return original $value or $return if it is greater than zero.
 * Return $substitute string if it is less.
 *
 * @param $value
 * @param string $substitute
 * @param mixed $return
 * @return mixed|string
 */
function zero_replace($value, $substitute = '-', $return = null)
{
    // Return $substitute if the $value is not greater than the 0
    return $value > 0 ? ($return ?? (int) $value) : $substitute;
}

/**
 * Remove illegal characters from a string to create an ID.
 *
 * @param $string
 * @return string
 */
function str2id($string)
{
    return strtolower(str_replace(' ', '-', str_replace('&', '-', $string)));
}

/**
 * Remove ' ', '-', '&' characters.
 *
 * @param $item
 * @return string
 */
function stripString($item)
{
    return strtolower(str_replace(',', '', str_replace(' ', '-', str_replace('&', '', $item))));
}

/**
 * Remove spaces and convert string to lowercase chars.
 *
 * @param $string
 * @return string|string[]
 */
function stringID($string)
{
    return str_replace(' ', '-', strtolower($string));
}

/**
 * Check if a needle string is in a haystack string.
 *
 * @param string $haystack
 * @param string $needle
 * @return bool
 */
function inString(string $haystack, string $needle): bool
{
    return strpos($haystack, $needle) !== false;
}

/**
 * Determine if the $string is a plain text list of values.
 *
 *  - if $string is a list, an array of values is returned
 *  - if $sting is a string, false is returned
 *
 * @param string $string
 * @param array|string[] $separators
 * @return bool|false|string[]
 */
function isListString(string $string, array $separators = [', ', ' '])
{
    foreach ($separators as $needle) {
        // If the $needle is found in the $string
        // we know the string is a plain text list
        // so an array of values is returned
        if (inString($string, $needle)) {
            return explode($needle, $string);
        }
    }

    // If none of the separators are found
    // we know the string is not a list
    return false;
}

/**
 * Explode a string using an array of delimiters instead of a single string.
 *
 * @param string $string
 * @param array|string[] $delimiters
 * @param string $replacer
 * @return array
 */
function explodeMany(string $string,
                     array $delimiters = [',', '&', '/', '-'],
                     string $replacer = '***'): array
{
    // Replace all of $delimiters chars with the
    // $replacer so that a single delimiter can
    // be used to explode the string
    $cleaned = str_replace($delimiters, $replacer, $string);

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
 * Pretty implode an array by using a different glue for the last piece.
 *
 * Examples:
 *  - implodePretty([1, 2, 3]) --> '1, 2 & 3'
 *  - implodePretty([A, B, D]) --> 'A, B & D'
 *
 * @param array $pieces
 * @param string $glue
 * @param string $and
 * @return string
 */
function implodePretty(array $pieces, string $glue = ',', string $and = '&')
{
    // Pop off the last item so that it's
    // imploded with the $and char
    $last = array_pop($pieces);

    // Do nothing and return $last if there
    // are no remaining $pieces
    if (! count($pieces)) {
        return $last;
    }

    // Implode all bust the last $piece
    // using the $glue char
    $start = implode(whitespacePadBack(trim($glue)), $pieces);

    // Implode comma separated $start with
    // & separated $last
    return implode(whitespacePad(trim($and)), [$start, $last]);
}

/**
 * Add whitespace padding to a string.
 *
 * @param string $string
 * @param int $amount
 * @param string $pad
 * @param bool $front add whitespace to 'front' of the string
 * @param bool $back add whitespace to the 'back' of the string
 * @return string
 */
function whitespacePad(string $string,
                       int $amount = 1,
                       string $pad = ' ',
                       bool $front = true,
                       bool $back = true)
{
    // Multiple $pad chars by $amount
    $whitespace = str_repeat($pad, $amount);

    // Return string with padding
    return ($front ? $whitespace : '').$string.($back ? $whitespace : '');
}

/**
 * Add whitespace padding to only the 'back' of the string.
 *
 * @param string $string
 * @param int $amount
 * @param string $pad
 * @return string
 */
function whitespacePadBack(string $string, int $amount = 1, string $pad = ' ')
{
    return whitespacePad($string, $amount, $pad, false, true);
}

/**
 * Add whitespace padding to only the 'back' of the string.
 *
 * @param string $string
 * @param int $amount
 * @param string $pad
 * @return string
 */
function whitespacePadFront(string $string, int $amount = 1, string $pad = ' ')
{
    return whitespacePad($string, $amount, $pad, true, false);
}


/**
 * Generate a random password using uniqueid & md5 functions
 *
 * @param int $length
 * @param string $prefix
 * @param string $hashFunction
 * @return string
 */
function random_password(int $length = 8, string $prefix = '', string $hashFunction = 'md5'): string
{
    return $prefix . truncateString($hashFunction(uniqid()), $length, '');
}
