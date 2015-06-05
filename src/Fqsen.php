<?php
/**
 * phpDocumentor
 *
 * PHP Version 5.5
 *
 * @copyright 2010-2015 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection;

/**
 * Value Object for Fqsen.
 *
 * @link https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc-meta.md
 */
final class Fqsen
{
    /**
     * @var string full quallified class name
     */
    private $fqsen;

    /**
     * Initializes the object.
     *
     * @param string $fqsen
     *
     * @throws \InvalidArgumentException when $fqsen is not matching the format.
     */
    public function __construct($fqsen)
    {
        $result = preg_match('/^\\\\([A-Za-z_\\\\]+)(::\\$?[a-zA-Z_]+)?(\\(\\))?$/', $fqsen);
        if ($result === 0) {
            throw new \InvalidArgumentException(
                sprintf('"%s" is not a valid Fqsen.', $fqsen)
            );
        }

        $this->fqsen = $fqsen;
    }

    /**
     * converts this class to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->fqsen;
    }
}
