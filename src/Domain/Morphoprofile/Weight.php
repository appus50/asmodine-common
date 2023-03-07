<?php

namespace Asmodine\CommonBundle\Domain\Morphoprofile;

use Asmodine\CommonBundle\Domain\AbstractSluggable;

/**
 * Class Weight.
 */
class Weight extends AbstractSluggable
{
    public const FIN = 'fin';
    public const CURVE = 'curve';

    /**
     * Get all size slug.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::FIN,
            self::CURVE,
        ];
    }

    /**
     * Get MorphoWeight value.
     *
     * @param string|null $gender
     * @param int|null    $height
     * @param int|null    $shoulder
     * @param int|null    $chest
     * @param int|null    $waist
     * @param int|null    $hip
     *
     * @return string|null
     */
    public static function get(?string $gender, ?int $height, ?int $shoulder, ?int $chest, ?int $waist, ?int $hip): ?string
    {
        if (!Gender::isMale($gender) && !Gender::isFemale($gender)) {
            return null;
        }
        if (null === $height || null === $shoulder || null === $chest || null === $waist || null === $hip) {
            return null;
        }

        if (Gender::isMale($gender)) {
            $shoulderLimit = log($height, 45.272) + 369.63;
            $chestLimit = log($height, 181.09) + 878.51;
            $waistLimit = log($height, 181.09) + 758.51;
            $hipLimit = log($height, 181.09) + 898.51;
        }
        if (Gender::isFemale($gender)) {
            $shoulderLimit = 225.227 * exp(2.739 * pow(10, -4) * $height);
            $chestLimit = 223.798 * exp(8.501 * pow(10, -4) * $height);
            $waistLimit = 117.56 * exp(1.089 * pow(10, -3) * $height);
            $hipLimit = 260.179 * exp(7.976 * pow(10, -4) * $height);
        }

        $nbBigger = ($shoulder >= $shoulderLimit ? 1 : 0)
            + ($chest >= $chestLimit ? 1 : 0)
            + ($waist >= $waistLimit ? 1 : 0)
            + ($hip >= $hipLimit ? 1 : 0);

        return $nbBigger >= 4 ? self::CURVE : self::FIN;
    }
}
