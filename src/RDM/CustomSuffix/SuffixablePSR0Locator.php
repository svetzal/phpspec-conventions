<?php

namespace RDM\CustomSuffix;

use PhpSpec\Locator\PSR0\PSR0Locator;
use PhpSpec\Util\Filesystem;

class SuffixablePSR0Locator extends PSR0Locator {

    private $extension;

    public function __construct(
        $srcNamespace = '',
        $specNamespacePrefix = 'spec',
        $srcPath = 'src',
        $specPath = '.',
        Filesystem $filesystem = null,
        $psr4Prefix = null,
        $extension = '.php' // extra param for Suffixable
    ) {
        parent::__construct($srcNamespace, $specNamespacePrefix, $srcPath, $specPath, $filesystem, $psr4Prefix);
        $this->extension = $extension;
    }

    // I've had to override createResource and duplicate the code that's in the superclass
    // because there's no Factory style approach to Resource object construction. Changes
    // have been made to the duplicated code in order to access private fields through the
    // existing accessor functions (specNamespace, srcNamespace, etc).
    public function createResource($classname) {
        $resource = null;

        $this->validatePsr0Classname($classname);

        $classname = str_replace('/', '\\', $classname);

        if (0 === strpos($classname, $this->getSpecNamespace())) {
            $relative = substr($classname, strlen($this->getSpecNamespace()));
            $resource = new SuffixablePSR0Resource(explode('\\', $relative), $this, $this->extension);
        } elseif ('' === $this->getSrcNamespace() || 0 === strpos($classname, $this->getSrcNamespace())) {
            $relative = substr($classname, strlen($this->getSrcNamespace()));
            $resource = new SuffixablePSR0Resource(explode('\\', $relative), $this, $this->extension);
        }

        return $resource;
    }

    // createResource depends on this function, it's an exact duplicate of the same method
    // in the base class, which is unfortunately marked private.
    private function validatePsr0Classname($classname) {
        $pattern = '/^([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*[\/\\\\]?)*[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';

        if (!preg_match($pattern, $classname)) {
            throw new InvalidArgumentException(
                sprintf('String "%s" is not a valid class name.', $classname) . PHP_EOL .
                'Please see reference document: ' .
                'https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md'
            );
        }
    }

}
