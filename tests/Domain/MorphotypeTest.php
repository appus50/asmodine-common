<?php

namespace App\Tests\Domain;

use Asmodine\CommonBundle\Domain\Morphotype;
use PHPUnit\Framework\TestCase;

/**
 * Class MorphotypeTest.
 */
class MorphotypeTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetSlugs()
    {
        $slugs = Morphotype::getSlugs();
        $constants = (new \ReflectionClass(Morphotype::class))->getConstants();

        foreach ($constants as $constant) {
            $this->assertTrue(\in_array($constant, $slugs, true), sprintf('Constant "%s" not in Morphotype::getSlugs() ', $constant));
        }

        $this->assertSame(\count($constants), \count($slugs), sprintf('%d constants != %d slugs', \count($constants), \count($slugs)));
    }

    /**
     * @throws \Asmodine\CommonBundle\Exception\EnumParameterException
     */
    public function testGet()
    {
        foreach (Morphotype\Skin::getSlugs() as $skin) {
            foreach (Morphotype\Hair::getSlugs() as $hair) {
                foreach (Morphotype\Eye::getSlugs() as $eyes) {
                    $this->assertContains(Morphotype::get($skin, $hair, $eyes), Morphotype::getSlugs());
                }
            }
        }
    }
}
