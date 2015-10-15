<?php

namespace spec\RDM\CustomSuffix;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RDM\CustomSuffix\SuffixablePSR0Locator;

class SuffixablePSR0ResourceSpec extends ObjectBehavior {
    function let(SuffixablePSR0Locator $locator) {
        $this->beConstructedWith(['My', 'Class'], $locator, '.class.php');
    }

    function it_is_initializable() {
        $this->shouldHaveType('RDM\CustomSuffix\SuffixablePSR0Resource');
    }

//    function it_should_generate_correct_suffix() {
//        echo $this->getSrcFilename();
//    }
}
