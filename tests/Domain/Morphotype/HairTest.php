<?php

namespace Tests\Asmodine\CommonBundle\Domain\Morphotype;

use Asmodine\CommonBundle\Domain\Morphotype\Hair;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class HairTest.
 */
class HairTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetSlugs()
    {
        $slugs = Hair::getSlugs();
        $constants = (new \ReflectionClass(Hair::class))->getConstants();

        foreach ($constants as $constant) {
            $this->assertTrue(\in_array($constant, $slugs, true), sprintf('Constant "%s" not in Hair::getSlugs() ', $constant));
        }

        $this->assertSame(\count($constants), \count($slugs), sprintf('%d constants != %d slugs', \count($constants), \count($slugs)));
    }

    public function testGetSlugsWithNull()
    {
        $slugs = Hair::getSlugsWithNull();
        $this->assertContains(null, $slugs);
        $this->assertGreaterThan(\count(Hair::getSlugs()), \count($slugs));
    }

    /**
     * @throws \ReflectionException
     */
    public function testTranslation()
    {
        $constants = (new \ReflectionClass(Hair::class))->getConstants();
        $morphoTrans = file_get_contents(__DIR__.'/../../../translations/morpho.fr.yaml');
        $trans = Yaml::parse($morphoTrans);
        $this->assertArrayHasKey('hair', $trans);
        $hairTrans = $trans['hair'];

        foreach ($constants as $constant) {
            $this->assertArrayHasKey($constant, $hairTrans, 'No translation "hair.'.$constant.'"');
        }
        foreach (array_keys($hairTrans) as $value) {
            $this->assertTrue(\in_array($value, array_values($constants), true), 'Unused translation "hair.'.$value.'"');
        }
    }
}
