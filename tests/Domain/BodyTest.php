<?php

namespace App\Tests\Domain;

use Asmodine\CommonBundle\Domain\Body;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class BodyTest.
 */
class BodyTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testGetSlugs()
    {
        $slugs = Body::getSlugs();
        $constants = (new \ReflectionClass(Body::class))->getConstants();

        foreach ($constants as $constant) {
            $this->assertTrue(\in_array($constant, $slugs, true), sprintf('Constant "%s" not in Body::getSlugs() ', $constant));
        }

        $this->assertSame(\count($constants), \count($slugs), sprintf('%d constants != %d slugs', \count($constants), \count($slugs)));
    }

    /**
     * @throws \ReflectionException
     */
    public function testTranslation()
    {
        $constants = (new \ReflectionClass(Body::class))->getConstants();
        $morphoTrans = file_get_contents(__DIR__.'/../../translations/morpho.fr.yaml');
        $trans = Yaml::parse($morphoTrans);
        $this->assertArrayHasKey('body', $trans);
        $bodyTrans = $trans['body'];

        foreach ($constants as $constant) {
            $this->assertArrayHasKey($constant, $bodyTrans, 'No translation "body.'.$constant.'"');
        }
        foreach (array_keys($bodyTrans) as $value) {
            $this->assertTrue(\in_array($value, array_values($constants), true), 'Unused translation "body.'.$value.'"');
        }
    }

    /**
     * @throws \ReflectionException
     */
    public function test2D3D()
    {
        $constants = array_values((new \ReflectionClass(Body::class))->getConstants());
        $twoD = Body::get2DMeasurementSlugs();
        $threeD = Body::get3DMeasurementSlugs();
        $diff = array_diff($constants, $twoD, $threeD);
        $intersect = array_intersect($twoD, $threeD);

        $this->assertCount(0, $intersect, sprintf('Dimension type in 2D & 3D : %s', var_export($intersect, true)));
        $this->assertCount(0, $diff, sprintf('Unknown dimension type : %s', var_export($diff, true)));
        $this->assertSame(\count($constants), \count($twoD) + \count($threeD));
    }
}
