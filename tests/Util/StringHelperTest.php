<?php

namespace Tests\Asmodine\CommonBundle\Util;

use Asmodine\CommonBundle\Util\StringHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class StringHelperTest.
 */
class StringHelperTest extends TestCase
{
    /**
     * Remove Accent.
     */
    public function testRemoveAccent()
    {
        $this->assertSame('', StringHelper::removeAccents(''));
        $this->assertSame('abcdefghijkklmnopqrstuvwxyz', StringHelper::removeAccents('abcdefghijkklmnopqrstuvwxyz'));
        $this->assertSame('a b   c', StringHelper::removeAccents('a b   c'));
        $this->assertSame('azeuoc', StringHelper::removeAccents('àzéùôç'));
        $this->assertSame('AAAAAACEEEEIIIINOOOOOUUUUYaaaaaaceeeeiiiinooooouuuuyy', StringHelper::removeAccents('ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝáàâäãåçéèêëíìîïñóòôöõúùûüýÿ'));
        $this->assertSame('', StringHelper::removeAccents(null));
    }

    /**
     * Slugify.
     */
    public function testSlugify()
    {
        $this->assertSame('hello-world', StringHelper::slugify('Hello World'));
        $this->assertSame('e-a-u-c-est-dur', StringHelper::slugify('é à ù c\'est dur'));
        $this->assertSame('jusqu-ou-peut-aller-cette-fonction', StringHelper::slugify('Jusqu\'où peut aller cette fonction +*$€%£ ?'));
        $this->assertSame('http-asmodine-com', StringHelper::slugify('http://asmodine.com'));
    }

    /**
     * Test String StartsWith.
     */
    public function testStartsWith()
    {
        $this->assertTrue(StringHelper::startsWith('abcdef', ''));
        $this->assertTrue(StringHelper::startsWith('abcdef', 'a'));
        $this->assertTrue(StringHelper::startsWith('abcdef', 'ab'));
        $this->assertTrue(StringHelper::startsWith('abcdef', 'abcdef'));
        $this->assertFalse(StringHelper::startsWith('abcdef', 'b'));
        $this->assertFalse(StringHelper::startsWith('abcdef', 'ef'));
        $this->assertFalse(StringHelper::startsWith('abcdef', 'bcd'));
        $this->assertFalse(StringHelper::startsWith('', 'abcdef'));

        for ($i = 0; $i < 5000; ++$i) {
            $haystack = StringHelper::generateHardPassword(rand(15, 21));
            $needle = StringHelper::generateHardPassword(rand(10, 15));
            if (substr($haystack, 0, \strlen($needle)) === $needle) {
                // Particular case
                $this->assertTrue(StringHelper::startsWith($haystack, $needle), '$i='.$i.' | H='.$haystack.' | N='.$needle);
            } else {
                // Normal case
                $this->assertFalse(StringHelper::startsWith($haystack, $needle), '$i='.$i.' | H='.$haystack.' | N='.$needle);
            }
        }

        for ($i = 0; $i < 500; ++$i) {
            $haystack = StringHelper::generateHardPassword(rand(11, 20));
            $needle = StringHelper::generateHardPassword(rand(0, 20));
            $this->assertTrue(StringHelper::startsWith($needle.$haystack, $needle), '$i='.$i.' | H='.$needle.$haystack.' | N='.$needle);
        }
    }

    /**
     * Test String EndsWith.
     */
    public function testEndsWith()
    {
        $this->assertTrue(StringHelper::endsWith('abcdef', ''));
        $this->assertTrue(StringHelper::endsWith('abcdef', 'f'));
        $this->assertTrue(StringHelper::endsWith('abcdef', 'ef'));
        $this->assertTrue(StringHelper::endsWith('abcdef', 'def'));
        $this->assertTrue(StringHelper::endsWith('abcdef', 'abcdef'));
        $this->assertFalse(StringHelper::endsWith('abcdef', 'a'));
        $this->assertFalse(StringHelper::endsWith('abcdef', 'X'));
        $this->assertFalse(StringHelper::endsWith('abcdef', 'cd'));
        $this->assertFalse(StringHelper::endsWith('', 'abcdef'));

        for ($i = 0; $i < 5000; ++$i) {
            $haystack = StringHelper::generateHardPassword(rand(15, 21));
            $needle = StringHelper::generateHardPassword(rand(10, 15));
            if (substr($haystack, -\strlen($needle)) === $needle) {
                // Cas Particulier
                $this->assertTrue(StringHelper::endsWith($haystack, $needle), '$i='.$i.' | H='.$haystack.' | N='.$needle);
            } else {
                // Cas Normal
                $this->assertFalse(StringHelper::endsWith($haystack, $needle), '$i='.$i.' | H='.$haystack.' | N='.$needle);
            }
        }

        for ($i = 0; $i < 500; ++$i) {
            $haystack = StringHelper::generateHardPassword(rand(11, 20));
            $needle = StringHelper::generateHardPassword(rand(0, 20));
            $this->assertTrue(StringHelper::endsWith($haystack.$needle, $needle), '$i='.$i.' | H='.$haystack.$needle.' | N='.$needle);
        }
    }

    /**
     * Test Simple Password.
     */
    public function testGenerateSimplePassword()
    {
        for ($i = 0; $i < 100; ++$i) {
            $length = rand(4, 64);
            $pwd = StringHelper::generateSimplePassword($length);
            $this->assertNotRegExp('/[^A-Za-z0-9]/', $pwd);
            $this->assertSame($length, \strlen($pwd));
        }
    }

    /**
     * Test Hard Password.
     */
    public function testGenerateHardPassword()
    {
        for ($i = 0; $i < 100; ++$i) {
            $length = rand(16, 256);
            $pwd = StringHelper::generateHardPassword($length);
            $this->assertNotRegExp('/[ ]/', $pwd);
            $this->assertSame($length, \strlen($pwd));
        }
    }
}
