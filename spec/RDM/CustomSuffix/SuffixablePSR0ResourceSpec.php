<?php

namespace spec\RDM\CustomSuffix;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RDM\CustomSuffix\SuffixablePSR0Locator;

class SuffixablePSR0ResourceSpec extends ObjectBehavior {
    function let(SuffixablePSR0Locator $locator) {
        $locator->getSrcNamespace()->willReturn('');
        $locator->getFullSrcPath()->willReturn('');
        $this->beConstructedWith(['My', 'Class'], $locator, '.class.php');
    }

    function it_is_initializable() {
        $this->shouldHaveType('RDM\CustomSuffix\SuffixablePSR0Resource');
    }

    function it_should_generate_correct_suffix() {
        $this->getSrcFilename()->shouldMatch('/.class.php$/');
    }
}
