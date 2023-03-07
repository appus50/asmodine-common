<?php

namespace Asmodine\CommonBundle\Domain\Morphotype;

use Asmodine\CommonBundle\Domain\AbstractSluggable;

/**
 * Class Skin.
 */
class Skin extends AbstractSluggable
{
    public const VERY_LIGHT = 'very_light';
    public const LIGHT = 'light';
    public const PINK = 'pink';
    public const MATTE = 'matte';
    public const DARK = 'dark';
    public const VERY_DARK = 'very_dark';

    /**
     * Get all color slug skin.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::VERY_LIGHT,
            self::LIGHT,
            self::PINK,
            self::MATTE,
            self::DARK,
            self::VERY_DARK,
        ];
    }

    /**
     * Get all color slug skin with null.
     *
     * @return array
     */
    public static function getSlugsWithNull(): array
    {
        return array_merge([null], self::getSlugs());
    }
}
