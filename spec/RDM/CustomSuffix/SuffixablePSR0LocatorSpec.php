<?php

namespace spec\RDM\CustomSuffix;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SuffixablePSR0LocatorSpec extends ObjectBehavior {
    function it_is_initializable() {
        $this->shouldHaveType('RDM\CustomSuffix\SuffixablePSR0Locator');
    }
}
