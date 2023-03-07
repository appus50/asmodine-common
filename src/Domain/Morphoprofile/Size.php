<?php

namespace Asmodine\CommonBundle\Domain\Morphoprofile;

use Asmodine\CommonBundle\Domain\AbstractSluggable;

/**
 * Class Size.
 */
class Size extends AbstractSluggable
{
    public const SMALL = 'small';
    public const TALL = 'tall';

    private const MEDIUM_MALE_SIZE = 1780;
    private const MEDIUM_FEMALE_SIZE = 1680;

    /**
     * Get all size slug.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::SMALL,
            self::TALL,
        ];
    }

    /**
     * Get Size value.
     *
     * @param string|null $gender
     * @param int|null    $height
     *
     * @return string|null
     */
    public static function get(?string $gender, ?int $height): ?string
    {
        if (null === $gender || null === $height) {
            return null;
        }
        $smallSize = Gender::isMale($gender) ? self::MEDIUM_MALE_SIZE : self::MEDIUM_FEMALE_SIZE;

        return $height <= $smallSize ? self::SMALL : self::TALL;
    }
}
