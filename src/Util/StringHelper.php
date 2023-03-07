<?php

namespace Asmodine\CommonBundle\Util;

use Cocur\Slugify\Slugify;

/**
 * Class String Helper.
 */
class StringHelper
{
    /**
     * Removes accents from a string.
     *
     * @param string $string
     *
     * @return string
     */
    public static function removeAccents(?string $string): string
    {
        if (null === $string) {
            return '';
        }

        $string = htmlentities($string, ENT_NOQUOTES);
        $string = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $string);
        $string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string); // For ligatures e.g. '&oelig;'
        $string = preg_replace('#&[^;]+;#', '', $string);

        return $string;
    }

    /**
     * Just slugify.
     *
     * @param string $string
     *
     * @return string
     */
    public static function slugify(?string $string): string
    {
        if (null === $string) {
            return 'n-a';
        }

        $slugify = new Slugify(['separator' => '-', 'trim' => true]);

        return $slugify->slugify($string);
    }

    /**
     * Transformation of snake case to camel case.
     * Ex : 'camel_case' => 'camelCase'.
     *
     * @param $string
     *
     * @return string
     */
    public static function toCamelCase(?string $string): string
    {
        if (null === $string) {
            return '';
        }

        return lcfirst(
            preg_replace_callback(
                '/(^|_|\.)+(.)/',
                function ($match) {
                    return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
                },
                $string
            )
        );
    }

    /**
     * Transformation of camel case to snake case.
     * Ex :  'camelCase' => 'camel_case'.
     *
     * @param string $string Camel case string
     *
     * @return string Snake case string
     */
    public static function toSnakeCase(?string $string): string
    {
        if (null === $string) {
            return '';
        }

        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }

    /**
     * @param array $array
     * @param bool  $isMap
     *
     * @return string
     */
    public static function arrayToString(array $array, bool $isMap = false): string
    {
        if ($isMap) {
            $tmp = $array;
            $array = [];
            array_walk($tmp, function ($value, $key) use ($array) {
                $array[] = sprintf('%s=>%s', $key, \is_array($value) ? json_encode($value) : $value);
            });
        }

        return '['.implode(', ', $array).']';
    }

    /**
     * Generates an alphanumeric password.
     *
     * @param int $length
     *
     * @return string
     */
    public static function generateSimplePassword($length = 8)
    {
        return self::generatePassword($length, 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789');
    }

    /**
     * Generates an alphanumeric password with special chars.
     *
     * @param int $length
     *
     * @return string
     */
    public static function generateHardPassword($length = 16)
    {
        return self::generatePassword($length, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?');
    }

    /**
     * TRUE if $haystack starts with $needle.
     *
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        return '' === $needle || false !== strrpos($haystack, $needle, -\strlen($haystack));
    }

    /**
     * TRUE if $haystack finished by $needle.
     *
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function endsWith($haystack, $needle)
    {
        return '' === $needle || (($temp = \strlen($haystack) - \strlen($needle)) >= 0 && false !== strpos($haystack, $needle, $temp));
    }

    /**
     * Generating a password from characters and a length.
     *
     * @param int   $length
     * @param mixed $chars
     *
     * @return string
     */
    private static function generatePassword($length, $chars)
    {
        $password = '';
        for ($i = 0; $i < $length; ++$i) {
            $password .= $chars[mt_rand(0, \strlen($chars) - 1)];
        }

        return $password;
    }
}
