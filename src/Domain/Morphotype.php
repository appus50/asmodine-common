<?php

namespace Asmodine\CommonBundle\Domain;

use Asmodine\CommonBundle\Domain\Morphotype\Eye;
use Asmodine\CommonBundle\Domain\Morphotype\Hair;
use Asmodine\CommonBundle\Domain\Morphotype\Skin;
use Asmodine\CommonBundle\Exception\EnumParameterException;
use Asmodine\CommonBundle\Exception\NullParameterException;

/**
 * Class Morphotype.
 */
class Morphotype
{
    /**
     * Spring :  Light complexion / Light hair.
     *
     * @var string
     */
    public const ASMOCLEAR = 'asmoclear';

    /**
     * Summer : Medium to Dark complexion / Light hair.
     *
     * @var string
     */
    public const ASMONUDE = 'asmonude';

    /**
     * Autumn : Medium complexion / Dark hair.
     *
     * @var string
     */
    public const ASMOGOLD = 'asmogold';

    /**
     * Winter : Light complexion / Dark hair.
     *
     * @var string
     */
    public const ASMOSILVER = 'asmosilver';

    /**
     *  Dark : Dark complexion / Dark hair.
     *
     * @var string
     */
    public const ASMODARK = 'asmodark';

    /**
     * Get all color slug skin.
     *
     * @return array
     */
    public static function getSlugs(): array
    {
        return [
            self::ASMOCLEAR,
            self::ASMONUDE,
            self::ASMOGOLD,
            self::ASMOSILVER,
            self::ASMODARK,
        ];
    }

    /**
     * Get Morphotype value.
     *
     * @param string|null $skin
     * @param string|null $hair
     * @param string|null $eyes
     *
     * @throws EnumParameterException
     *
     * @return string|null
     */
    public static function get(?string $skin, ?string $hair, ?string $eyes): ?string
    {
        try {
            Skin::checkSlug($skin);
            Hair::checkSlug($hair);
            Eye::checkSlug($eyes);
        } catch (NullParameterException $nullParameterException) {
            return null;
        } catch (EnumParameterException $enumParameterException) {
            throw $enumParameterException;
        }

        return self::getMorphotype($skin, $hair, $eyes);
    }

    /**
     * Finds and return morphotype.
     *
     * @param string $skin
     * @param string $hair
     * @param string $eyes
     *
     * @return string
     */
    private static function getMorphotype(string $skin, string $hair, string $eyes): string
    {
        //TODO Validate values with auburn & red
        $datas = [
            Skin::VERY_LIGHT => [
                Hair::WHITE => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMONUDE, Eye::BLACK => self::ASMOSILVER],
                Hair::BLOND => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMONUDE, Eye::BLACK => self::ASMOSILVER],
                Hair::LIGHT_BROWN => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMONUDE, Eye::BLACK => self::ASMOSILVER],
                Hair::HONEY => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::OTHERS => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::RED => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::BROWN => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::BLACK => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
            ],
            Skin::LIGHT => [
                Hair::WHITE => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMONUDE, Eye::BLACK => self::ASMOSILVER],
                Hair::BLOND => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOSILVER],
                Hair::LIGHT_BROWN => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::HONEY => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMONUDE, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::OTHERS => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::RED => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::BROWN => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::BLACK => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
            ],
            Skin::PINK => [
                Hair::WHITE => [Eye::BLUE => self::ASMOCLEAR, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMONUDE, Eye::BLACK => self::ASMOGOLD],
                Hair::BLOND => [Eye::BLUE => self::ASMOCLEAR, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMONUDE, Eye::BLACK => self::ASMOGOLD],
                Hair::LIGHT_BROWN => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::HONEY => [Eye::BLUE => self::ASMONUDE, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::OTHERS => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::RED => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::BROWN => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::BLACK => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
            ],
            Skin::MATTE => [
                Hair::WHITE => [Eye::BLUE => self::ASMOCLEAR, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::BLOND => [Eye::BLUE => self::ASMOCLEAR, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::LIGHT_BROWN => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::HONEY => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::OTHERS => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::RED => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::BROWN => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::BLACK => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
            ],
            Skin::DARK => [
                Hair::WHITE => [Eye::BLUE => self::ASMOCLEAR, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::BLOND => [Eye::BLUE => self::ASMOCLEAR, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::LIGHT_BROWN => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOCLEAR, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOGOLD],
                Hair::HONEY => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::OTHERS => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::RED => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::BROWN => [Eye::BLUE => self::ASMODARK, Eye::GREEN_GRAY => self::ASMODARK, Eye::BROWN => self::ASMODARK, Eye::BLACK => self::ASMODARK],
                Hair::BLACK => [Eye::BLUE => self::ASMODARK, Eye::GREEN_GRAY => self::ASMODARK, Eye::BROWN => self::ASMODARK, Eye::BLACK => self::ASMODARK],
            ],
            Skin::VERY_DARK => [
                Hair::WHITE => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::BLOND => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::LIGHT_BROWN => [Eye::BLUE => self::ASMOSILVER, Eye::GREEN_GRAY => self::ASMOSILVER, Eye::BROWN => self::ASMOSILVER, Eye::BLACK => self::ASMOSILVER],
                Hair::HONEY => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::OTHERS => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::RED => [Eye::BLUE => self::ASMOGOLD, Eye::GREEN_GRAY => self::ASMOGOLD, Eye::BROWN => self::ASMOGOLD, Eye::BLACK => self::ASMOGOLD],
                Hair::BROWN => [Eye::BLUE => self::ASMODARK, Eye::GREEN_GRAY => self::ASMODARK, Eye::BROWN => self::ASMODARK, Eye::BLACK => self::ASMODARK],
                Hair::BLACK => [Eye::BLUE => self::ASMODARK, Eye::GREEN_GRAY => self::ASMODARK, Eye::BROWN => self::ASMODARK, Eye::BLACK => self::ASMODARK],
            ],
        ];

        return $datas[$skin][$hair][$eyes];
    }
}
