<?php

namespace RDM\PHPSpec;

use PhpSpec\Locator\ResourceInterface;
use PhpSpec\Locator\ResourceLocatorInterface;
use PhpSpec\Util\Filesystem;

class ClassLocator implements ResourceLocatorInterface {

    /**
     * @return ResourceInterface[]
     */
    public function getAllResources() {
        // TODO: Implement getAllResources() method.
        return array();
    }

    /**
     * @param string $query
     *
     * @return boolean
     */
    public function supportsQuery($query) {
        echo "CHECKING: $query\n";
        return false;
    }

    /**
     * @param string $query
     *
     * @return ResourceInterface[]
     */
    public function findResources($query) {
        // TODO: Implement findResources() method.
    }

    /**
     * @param string $classname
     *
     * @return boolean
     */
    public function supportsClass($classname) {
        // TODO: Implement supportsClass() method.
    }

    /**
     * @param string $classname
     *
     * @return ResourceInterface|null
     */
    public function createResource($classname) {
        // TODO: Implement createResource() method.
    }

    /**
     * @return integer
     */
    public function getPriority() {
        // TODO: Implement getPriority() method.
    }
}