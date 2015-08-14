<?php

namespace RDM\PHPSpec;

use PhpSpec\Locator\ResourceInterface;

class SimpleResource implements ResourceInterface {

    private $name, $srcFilename;

    public function __construct($path) {
        $this->srcFilename = $path;
        $matches = array();
        preg_match("/^(\\w+)(.+)$/", $path, $matches);
        $this->name = $matches[1];
        $this->fileSuffix = $matches[2];
     }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSpecName() {
        return $this->name . "Spec";
    }

    /**
     * @return string
     */
    public function getSrcFilename() {
        return $this->srcFilename;
    }

    /**
     * @return string
     */
    public function getSrcClassname() {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getSpecFilename() {
        return $this->getSpecName() . $this->fileSuffix;
    }

    /**
     * @return string
     */
    public function getSpecClassname() {
        return $this->getSpecName();
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