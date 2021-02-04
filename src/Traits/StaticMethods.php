<?php

namespace Sfneal\Helpers\Strings\Traits;

trait StaticMethods
{
    /**
     * Implode values that are not null.
     *
     * @param $glue
     * @param array $pieces
     * @return string|null
     */
    public static function implodeFiltered($glue, array $pieces): ?string
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
     * Concatenate directory and file path arrays.
     *
     * @param mixed ...$paths
     * @return string
     */
    public static function joinPaths(...$paths): string
    {
        if (count($paths) === count($paths, COUNT_RECURSIVE)) {
            $paths = array_values($paths);
        }

        return implode(DIRECTORY_SEPARATOR, $paths);
    }

    /**
     * Retrieve a website domain without prefixes.
     *
     * @param string $url
     * @return string
     */
    public static function extractWebsiteDomain(string $url): string
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
     * @return mixed
     */
    public static function zeroReplace($value, $substitute = '-', $return = null)
    {
        // Return $substitute if the $value is not greater than the 0
        return $value > 0 ? ($return ?? (int) $value) : $substitute;
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
    public static function implodePretty(array $pieces, string $glue = ',', string $and = '&'): ?string
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
}
