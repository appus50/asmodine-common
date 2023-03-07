<?php

namespace Tests\Asmodine\CommonBundle\Domain;

use Asmodine\CommonBundle\Domain\SluggableInterface;
use Asmodine\CommonBundle\Exception\EnumParameterException;
use PHPUnit\Framework\TestCase;

/**
 * Class SluggableTest.
 */
class SluggableTest extends TestCase
{
    /**
     * @see SluggableInterface::getSlugs()
     */
    public function testGetSlugs()
    {
        $classes = $this->getSluggableClasses();
        $this->assertGreaterThan(0, \count($classes), 'No SluggableInterface implementation');
        foreach ($classes as $class) {
            $this->assertGreaterThan(0, \count($class::getSlugs()));
        }
    }

    /**
     * @see SluggableInterface::checkSlug()
     */
    public function testCheckSlugs()
    {
        $classes = $this->getSluggableClasses();
        $this->assertGreaterThan(0, \count($classes), 'No SluggableInterface implementation');

        /** @var SluggableInterface $class */
        foreach ($classes as $class) {
            $slugs = $class::getSlugs();
            foreach ($slugs as $slug) {
                try {
                    $class::checkSlug($slug);
                } catch (\Exception $exception) {
                    $this->assertFalse(true, 'class:'.$class.' slug:'.$slug."\n".$exception->getTraceAsString());
                }
            }
            for ($i = 1, $same = 0; $i <= 1000; ++$i) {
                $rand = bin2hex(openssl_random_pseudo_bytes(64));
                if (\in_array($rand, $slugs, true)) {
                    ++$same;
                }
                if (!\in_array($rand, $slugs, true)) {
                    try {
                        $class::checkSlug($rand);
                    } catch (\Exception $exception) {
                        $this->assertInstanceOf(EnumParameterException::class, $exception, $exception->getMessage());
                    }
                }
            }
            $this->assertLessThan(3, $same);
        }
    }

    /**
     * @return array
     */
    private function getSluggableClasses(): array
    {
        $classes = get_declared_classes();
        $classes = array_filter(
            $classes, function ($class) {
                $reflection = new \ReflectionClass($class);

                return isset(class_implements($class)[SluggableInterface::class]) && !$reflection->isAbstract();
            }
        );

        return $classes;
    }
}
