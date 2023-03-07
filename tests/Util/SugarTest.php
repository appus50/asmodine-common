<?php

namespace Tests\Asmodine\CommonBundle\Util;

use Asmodine\CommonBundle\Util\Sugar;
use PHPUnit\Framework\TestCase;

/**
 * Class SugarTest.
 */
class SugarTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testNow()
    {
        $this->assertInstanceOf(\DateTime::class, Sugar::now());
        $d = new \DateTime();
        $diff = $d->diff(Sugar::now());
        $this->assertSame(0, $diff->y);
        $this->assertSame(0, $diff->m);
        $this->assertSame(0, $diff->d);
        $this->assertSame(0, $diff->h);
        $this->assertSame(0, $diff->i);
        $this->assertSame(0, $diff->s);
    }
}
