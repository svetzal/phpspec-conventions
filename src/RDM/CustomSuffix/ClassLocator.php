<?php

namespace RDM\CustomSuffix;

use PhpSpec\Locator\PSR0\PSR0Locator;
use PhpSpec\Locator\PSR0\PSR0Resource;
use PhpSpec\Locator\ResourceInterface;
use PhpSpec\Locator\ResourceLocatorInterface;
use PhpSpec\Util\Filesystem;

class ClassLocator extends PSR0Locator {

    private $extension;

    public function __construct(
        $srcNamespace = '',
        $specNamespacePrefix = 'spec',
        $srcPath = 'src',
        $specPath = '.',
        Filesystem $filesystem = null,
        $psr4Prefix = null,
        $extension = '.php'
    ) {
        parent::__construct($srcNamespace, $specNamespacePrefix, $srcPath, $specPath, $filesystem, $psr4Prefix);
        $this->extension = $extension;
    }

    # Override parent method
    public function createResource($classname) {
        $resource = null;

        $this->validatePsr0Classname($classname);

        $classname = str_replace('/', '\\', $classname);

        if (0 === strpos($classname, $this->getSpecNamespace())) {
            $relative = substr($classname, strlen($this->getSpecNamespace()));
            $resource = new SimpleResource(explode('\\', $relative), $this, $this->extension);
        } elseif ('' === $this->getSrcNamespace() || 0 === strpos($classname, $this->getSrcNamespace())) {
            $relative = substr($classname, strlen($this->getSrcNamespace()));
            $resource = new SimpleResource(explode('\\', $relative), $this, $this->extension);
        }

        return $resource;
    }

    private function validatePsr0Classname($classname) {
        $pattern = '/^([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*[\/\\\\]?)*[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';

        if (!preg_match($pattern, $classname)) {
            throw new InvalidArgumentException(
                sprintf('String "%s" is not a valid class name.', $classname).PHP_EOL.
                'Please see reference document: '.
                'https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md'
            );
        }
    }

}
