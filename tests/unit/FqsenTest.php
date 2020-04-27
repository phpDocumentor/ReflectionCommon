<?php

declare(strict_types=1);

/**
 * phpDocumentor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \phpDocumentor\Reflection\Fqsen
 */
class FqsenTest extends TestCase
{
    /**
     * @covers ::__construct
     * @dataProvider validFqsenProvider
     */
    public function testValidFormats(string $fqsen, string $name) : void
    {
        $instance = new Fqsen($fqsen);
        $this->assertEquals($name, $instance->getName());
    }

    /**
     * Data provider for ValidFormats tests. Contains a complete list from psr-5 draft.
     *
     * @return array<array<string>>
     */
    public function validFqsenProvider() : array
    {
        return [
            ['\\', ''],
            ['\My\Space', 'Space'],
            ['\My\Space\myFunction()', 'myFunction'],
            ['\My\Space\MY_CONSTANT', 'MY_CONSTANT'],
            ['\My\Space\MY_CONSTANT2', 'MY_CONSTANT2'],
            ['\My\Space\MyClass', 'MyClass'],
            ['\My\Space\MyInterface', 'MyInterface'],
            ['\My\Space\Option«T»', 'Option«T»'],
            ['\My\Space\MyTrait', 'MyTrait'],
            ['\My\Space\MyClass::myMethod()', 'myMethod'],
            ['\My\Space\MyClass::$my_property', 'my_property'],
            ['\My\Space\MyClass::MY_CONSTANT', 'MY_CONSTANT'],
        ];
    }

    /**
     * @covers ::__construct
     * @dataProvider invalidFqsenProvider
     */
    public function testInValidFormats(string $fqsen) : void
    {
        $this->expectException(InvalidArgumentException::class);
        new Fqsen($fqsen);
    }

    /**
     * Data provider for invalidFormats tests. Contains a complete list from psr-5 draft.
     *
     * @return array<array<string>>
     */
    public function invalidFqsenProvider() : array
    {
        return [
            ['\My\*'],
            ['\My\Space\.()'],
            ['My\Space'],
            ['1_function()'],
        ];
    }

    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testToString() : void
    {
        $className = new Fqsen('\\phpDocumentor\\Application');

        $this->assertEquals('\\phpDocumentor\\Application', (string) $className);
    }
}
