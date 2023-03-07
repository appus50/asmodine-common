<?php

namespace Asmodine\CommonBundle\Domain\Morphoprofile;

use Asmodine\CommonBundle\Domain\AbstractSluggable;

/**
 * Class Gender.
 */
class Gender extends AbstractSluggable
{
    public const MALE = 'm';
    public const FEMALE = 'f';
    public const NOBODY = 'x'; // Nobody != gender neutral => Use to detect products that can not be used in Asmodine

    /**
     * Get all gender slug.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::MALE,
            self::FEMALE,
            self::NOBODY,
        ];
    }

    /**
     * Is male ?
     *
     * @param string $gender
     *
     * @return bool
     */
    public static function isMale(string $gender): bool
    {
        $first = substr($gender, 0, 1);

        return 0 === strcasecmp(self::MALE, $first) || 0 === strcasecmp('h', $first);
    }

    /**
     * Is female ?
     *
     * @param string $gender
     *
     * @return bool
     */
    public static function isFemale(string $gender): bool
    {
        $first = substr($gender, 0, 1);

        return 0 === strcasecmp(self::FEMALE, $first) || 0 === strcasecmp('w', $first);
    }

    /**
     * Returns letter m, f or x.
     *
     * @param string|null $gender
     *
     * @return string|null
     */
    public static function getLetter(?string $gender): ?string
    {
        if (null === $gender) {
            return null;
        }
        if (self::isMale($gender)) {
            return self::MALE;
        }
        if (self::isFemale($gender)) {
            return self::FEMALE;
        }

        return self::NOBODY;
    }
}
