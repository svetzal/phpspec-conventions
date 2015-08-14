<?php

namespace spec\RDM\PHPSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleResourceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith("MyFeature.class.php");
        $this->shouldHaveType('RDM\PHPSpec\SimpleResource');
    }

    function it_has_the_correct_src_path() {
        $this->beConstructedWith("MyFeature.class.php");
        $this->getSrcFilename()->shouldBe("MyFeature.class.php");
    }

    function it_extracts_the_right_parts_for_a_simple_path() {
        $this->beConstructedWith("MyFeature.class.php");
        $this->getName()->shouldBe("MyFeature");
        $this->getSrcClassname()->shouldBe("MyFeature");
        $this->getSpecNamespace()->shouldBe("");
        $this->getSpecName()->shouldBe("MyFeatureSpec");
        $this->getSpecFilename()->shouldBe("MyFeatureSpec.class.php");
    }

    function it_extracts_the_right_parts_for_a_complex_path() {
        $this->beConstructedWith("RDM/Namespace/MyFeature.class.php");
        $this->getSrcNamespace()->shouldBe("RDM\\Namespace");
        $this->getName()->shouldBe("RDM\\Namespace\\MyFeature");
    }
}
