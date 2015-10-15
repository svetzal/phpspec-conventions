<?php

namespace RDM\CustomSuffix;

use PhpSpec\Locator\PSR0\PSR0Resource;

class SimpleResource extends PSR0Resource {

    private $extension;

    public function __construct(array $parts, ClassLocator $locator, $extension) {
        parent::__construct($parts, $locator);
        $this->extension = $extension;
    }

    public function getSrcFilename() {
        $filename = parent::getSrcFilename();
        $filename = preg_replace("/.php$/", $this->extension, $filename);
        return $filename;
    }

}
