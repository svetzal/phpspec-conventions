<?php

namespace RDM\PHPSpec;

use PhpSpec\Locator\ResourceInterface;

class SimpleResource implements ResourceInterface {

    private $name, $srcFilename, $srcClassname;
    private $specName, $specFilename, $specClassname;

    public function __construct($path) {
        $this->srcFilename = $path;
    }

    /**
     * @return string
     */
    public function getName() {
         // TODO: Implement getName() method.
    }

    /**
     * @return string
     */
    public function getSpecName() {
        // TODO: Implement getSpecName() method.
    }

    /**
     * @return string
     */
    public function getSrcFilename() {
        // TODO: Implement getSrcFilename() method.
    }

    /**
     * @return string
     */
    public function getSrcClassname() {
        // TODO: Implement getSrcClassname() method.
    }

    /**
     * @return string
     */
    public function getSpecFilename() {
        // TODO: Implement getSpecFilename() method.
    }

    /**
     * @return string
     */
    public function getSpecClassname() {
        // TODO: Implement getSpecClassname() method.
    }

    /**
     * @return string
     */
    public function getSrcNamespace() {
        return '';
    }

    /**
     * @return string
     */
    public function getSpecNamespace() {
        return '';
    }
}