<?php

namespace Asmodine\CommonBundle\Domain;

use Asmodine\CommonBundle\Domain\Morphoprofile\Gender;
use Asmodine\CommonBundle\Domain\Morphoprofile\Weight;

/**
 * Class Morphoprofile.
 */
class Morphoprofile extends AbstractSluggable
{
    const H = 'h'; // M + F
    const O = 'o'; // M + F
    const A = 'a'; // M + F
    const V = 'v'; // M + F
    const X = 'x'; // F
    const EIGHT = '8'; // F
    const ZERO = '0'; // H

    /**
     * Get all morphoprofile slug.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::H,
            self::O,
            self::A,
            self::V,
            self::X,
            self::EIGHT,
            self::ZERO,
        ];
    }

    /**
     * @param string|null $gender
     *
     * @return array
     */
    public static function getSlugsByGender(?string $gender): array
    {
        if (null === $gender) {
            return self::getSlugs();
        }

        if (Gender::MALE === $gender) {
            return [self::H, self::O, self::A, self::V, self::ZERO];
        }
        if (Gender::FEMALE === $gender) {
            return [self::H, self::O, self::A, self::V, self::X, self::EIGHT];
        }

        return [];
    }

    /**
     * Get Morphotype value.
     *
     * @param string|null $gender
     * @param int|null    $shoulder2D
     * @param int|null    $waist2D
     * @param int|null    $hip2D
     * @param string|null $weight
     *
     * @return string|null
     */
    public static function get(?string $gender, ?int $shoulder2D, ?int $waist2D, ?int $hip2D, ?string $weight): ?string
    {
        if (null === $gender
            || null === $shoulder2D || null === $waist2D || null === $hip2D
            || null === $weight) {
            return null;
        }

        $morpho = self::compute2D($shoulder2D, $waist2D, $hip2D);

        if (Gender::isMale($gender) && self::X === $morpho) {
            $morpho = self::H;
        }

        if (\in_array($morpho, [self::H, self::X], true)) {
            $morpho = self::compute3D($morpho, $weight);
        }

        return $morpho;
    }

    /**
     * Returns the basic morphos H, O, A, V, X.
     *
     * @param int $shoulder2D
     * @param int $waist2D
     * @param int $hip2D
     *
     * @return string
     */
    private static function compute2D(int $shoulder2D, int $waist2D, int $hip2D): string
    {
        $margin = 30; // TODO => Parameters Files
        if (self::inMargin([$shoulder2D, $waist2D, $hip2D], $margin)) {
            return self::H;
        }

        if ($waist2D >= $shoulder2D && $waist2D >= $hip2D) {
            return self::O;
        }

        if (self::inMargin([$shoulder2D, $hip2D], $margin)) {
            return self::X;
        }

        if ($shoulder2D > $hip2D) {
            return self::V;
        }

        if ($shoulder2D < $hip2D) {
            return self::A;
        }
    }

    /**
     * Transform the X into 8 and H into O if necessary.
     *
     * @param string $morpho
     * @param string $weight
     *
     * @return string
     */
    private static function compute3D(string $morpho, string $weight): string
    {
        if (Weight::CURVE === $weight && self::X === $morpho) {
            return self::EIGHT;
        }

        if (Weight::CURVE === $weight && self::H === $morpho) {
            return self::O;
        }

        return $morpho;
    }

    /**
     * Checks if the difference between minimum and maximum is within the margin.
     *
     * @param array $values
     * @param int   $margin
     *
     * @return bool
     */
    private static function inMargin(array $values, int $margin): bool
    {
        return (max($values) - min($values)) <= $margin;
    }
}
