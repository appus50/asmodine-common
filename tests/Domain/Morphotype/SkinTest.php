<?php

namespace Tests\Asmodine\CommonBundle\Domain\Morphotype;

use Asmodine\CommonBundle\Domain\Morphotype\Skin;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class SkinTest.
 */
class SkinTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetSlugs()
    {
        $slugs = Skin::getSlugs();
        $constants = (new \ReflectionClass(Skin::class))->getConstants();

        foreach ($constants as $constant) {
            $this->assertTrue(\in_array($constant, $slugs, true), sprintf('Constant "%s" not in Skin::getSlugs() ', $constant));
        }

        $this->assertSame(\count($constants), \count($slugs), sprintf('%d constants != %d slugs', \count($constants), \count($slugs)));
    }

    public function testGetSlugsWithNull()
    {
        $slugs = Skin::getSlugsWithNull();
        $this->assertContains(null, $slugs);
        $this->assertGreaterThan(\count(Skin::getSlugs()), \count($slugs));
    }

    /**
     * @throws \ReflectionException
     */
    public function testTranslation()
    {
        $constants = (new \ReflectionClass(Skin::class))->getConstants();
        $morphoTrans = file_get_contents(__DIR__.'/../../../translations/morpho.fr.yaml');
        $trans = Yaml::parse($morphoTrans);
        $this->assertArrayHasKey('skin', $trans);
        $skinTrans = $trans['skin'];

        foreach ($constants as $constant) {
            $this->assertArrayHasKey($constant, $skinTrans, 'No translation "skin.'.$constant.'"');
        }
        foreach (array_keys($skinTrans) as $value) {
            $this->assertTrue(\in_array($value, array_values($constants), true), 'Unused translation "skin.'.$value.'"');
        }
    }
}
