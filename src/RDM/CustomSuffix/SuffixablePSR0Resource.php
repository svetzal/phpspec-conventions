<?php

namespace RDM\CustomSuffix;

use PhpSpec\Locator\PSR0\PSR0Resource;

class SuffixablePSR0Resource extends PSR0Resource {

    private $extension;

    // We need to be able to specify an alternate extension for class filenames,
    // so for now I've tacked this onto the constructor.
    public function __construct(array $parts, SuffixablePSR0Locator $locator, $extension) {
        parent::__construct($parts, $locator);
        $this->extension = $extension;
    }

    // This is a bit hacky, I could have used more flexibility in the base class. But it's
    // functional, and should be fairly responsive to changes in PSR0Resource.
    public function getSrcFilename() {
        $filename = parent::getSrcFilename();
        $filename = preg_replace("/.php$/", $this->extension, $filename);
        return $filename;
    }

}
