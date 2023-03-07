<?php

namespace Asmodine\CommonBundle\Domain\Morphotype;

use Asmodine\CommonBundle\Domain\AbstractSluggable;

/**
 * Class Eye.
 */
class Eye extends AbstractSluggable
{
    public const BLUE = 'blue';
    public const GREEN_GRAY = 'green_gray';
    public const BROWN = 'brown';
    public const BLACK = 'black';

    /**
     * Get all color slug eye.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::BLUE,
            self::GREEN_GRAY,
            self::BROWN,
            self::BLACK,
        ];
    }

    /**
     * Get all color slug eye with null.
     *
     * @return array
     */
    public static function getSlugsWithNull(): array
    {
        return array_merge([null], self::getSlugs());
    }
}
