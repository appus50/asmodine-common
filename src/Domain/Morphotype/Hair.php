<?php

namespace Asmodine\CommonBundle\Domain\Morphotype;

use Asmodine\CommonBundle\Domain\AbstractSluggable;

/**
 * Class Hair.
 */
class Hair extends AbstractSluggable
{
    const WHITE = 'white'; // White & Grey
    const BLOND = 'blond';
    const HONEY = 'honey';
    const RED = 'red';
    const LIGHT_BROWN = 'light_brown';
    const BROWN = 'brown';
    const BLACK = 'black';
    const OTHERS = 'others';

    /**
     * Get all color slug hair.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::WHITE,
            self::BLOND,
            self::HONEY,
            self::LIGHT_BROWN,
            self::RED,
            self::BROWN,
            self::BLACK,
            self::OTHERS,
        ];
    }

    /**
     * Get all color slug hair with null.
     *
     * @return array
     */
    public static function getSlugsWithNull(): array
    {
        return array_merge([null], self::getSlugs());
    }
}
