<?php

namespace Tests\Asmodine\CommonBundle\Domain\Morphotype;

use Asmodine\CommonBundle\Domain\Morphotype\Eye;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class EyeTest.
 */
class EyeTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetSlugs()
    {
        $slugs = Eye::getSlugs();
        $constants = (new \ReflectionClass(Eye::class))->getConstants();

        foreach ($constants as $constant) {
            $this->assertTrue(\in_array($constant, $slugs, true), sprintf('Constant "%s" not in Eye::getSlugs() ', $constant));
        }

        $this->assertSame(\count($constants), \count($slugs), sprintf('%d constants != %d slugs', \count($constants), \count($slugs)));
    }

    public function testGetSlugsWithNull()
    {
        $slugs = Eye::getSlugsWithNull();
        $this->assertContains(null, $slugs);
        $this->assertGreaterThan(\count(Eye::getSlugs()), \count($slugs));
    }

    /**
     * @throws \ReflectionException
     */
    public function testTranslation()
    {
        $constants = (new \ReflectionClass(Eye::class))->getConstants();
        $morphoTrans = file_get_contents(__DIR__.'/../../../translations/morpho.fr.yaml');
        $trans = Yaml::parse($morphoTrans);
        $this->assertArrayHasKey('eye', $trans);
        $eyeTrans = $trans['eye'];

        foreach ($constants as $constant) {
            $this->assertArrayHasKey($constant, $eyeTrans, 'No translation "eye.'.$constant.'"');
        }
        foreach (array_keys($eyeTrans) as $value) {
            $this->assertTrue(\in_array($value, array_values($constants), true), 'Unused translation "eye.'.$value.'"');
        }
    }
}
