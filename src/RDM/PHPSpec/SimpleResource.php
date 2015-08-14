<?php

namespace RDM\PHPSpec;

use PhpSpec\Locator\ResourceInterface;

class SimpleResource implements ResourceInterface {

    private $name, $type, $path, $namespace;

    private $specSuffix = "Spec";
    private $ext = 'php';
    private $namespaceJoin = '\\';
    private $typeJoin = '.';
    private $extJoin = '.';

    public function __construct($path) {
        $matches = array();
        preg_match('/^(.*\/)*(\w+)\.(.+)\.php/', $path, $matches);
        $this->path = $matches[1];
        $this->namespace = str_replace('/', "\\", rtrim($matches[1], '/'));
        $this->name = $matches[2];
        $this->type = $matches[3];
     }

    public function getName() {
        return $this->addNamespaceTo($this->name);
    }

    public function getSpecName() {
        return $this->addNamespaceTo($this->name . $this->specSuffix);
    }

    public function getSrcFilename() {
        return $this->path . $this->addFullSuffixTo($this->name);
    }

    public function getSpecFilename() {
        return $this->path . $this->addFullSuffixTo($this->name . $this->specSuffix);
    }

    public function getSrcClassname() {
        return $this->name;
    }

    public function getSpecClassname() {
        return $this->name . $this->specSuffix;
    }

    public function getSrcNamespace() {
        return $this->namespace;
    }

    public function getSpecNamespace() {
        return $this->namespace;
    }

    private function addNamespaceTo($input) {
        $prefix = '';
        if ($this->namespace) {
            $prefix .= $this->namespace . $this->namespaceJoin;
        }
        return $prefix . $input;
    }

    private function addFullSuffixTo($input) {
        return $input . $this->typeJoin . $this->type . $this->extJoin . $this->ext;
    }

}