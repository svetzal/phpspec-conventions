<?php

namespace spec\RDM\CustomSuffix;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExtensionSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType('RDM\CustomSuffix\Extension');
    }
}
