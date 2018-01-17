<?php
/**
 * phpDocumentor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2018 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection;

use PHPUnit\Framework\TestCase;

/**
 * Class FqsenTest
 * @coversDefaultClass phpDocumentor\Reflection\Fqsen
 */
class FqsenTest extends TestCase
{
    /**
     * @param string $fqsen
     * @covers ::__construct
     * @dataProvider validFqsenProvider
     */
    public function testValidFormats($fqsen, $name)
    {
        $instance = new Fqsen($fqsen);
        $this->assertEquals($name, $instance->getName());
    }

    /**
     * Data provider for ValidFormats tests. Contains a complete list from psr-5 draft.
     *
     * @return array
     */
    public function validFqsenProvider()
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
     * @param string $fqsen
     * @covers ::__construct
     * @dataProvider invalidFqsenProvider
     * @expectedException \InvalidArgumentException
     */
    public function testInValidFormats($fqsen)
    {
        new Fqsen($fqsen);
    }

    /**
     * Data provider for invalidFormats tests. Contains a complete list from psr-5 draft.
     *
     * @return array
     */
    public function invalidFqsenProvider()
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
    public function testToString()
    {
        $className = new Fqsen('\\phpDocumentor\\Application');

        $this->assertEquals('\\phpDocumentor\\Application', (string) $className);
    }
}
