<?php

namespace spec\RDM\PHPSpec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleResourceSpec extends ObjectBehavior
{
    function it_is_initializable() {
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
        $this->getSpecName()->shouldBe("MyFeatureSpec");

        $this->getSrcClassname()->shouldBe("MyFeature");
        $this->getSpecClassname()->shouldBe("MyFeatureSpec");

        $this->getSrcFilename()->shouldBe("MyFeature.class.php");
        $this->getSpecFilename()->shouldBe("MyFeatureSpec.class.php");

        $this->getSrcNamespace()->shouldBe("");
        $this->getSpecNamespace()->shouldBe("");
    }

    function it_extracts_the_right_parts_for_a_complex_path() {
        $this->beConstructedWith("RDM/Namespace/MyFeature.class.php");

        $this->getName()->shouldBe("RDM\\Namespace\\MyFeature");
        $this->getSpecName()->shouldBe("RDM\\Namespace\\MyFeatureSpec");

        $this->getSrcClassName()->shouldBe("MyFeature");
        $this->getSpecClassname()->shouldBe("MyFeatureSpec");

        $this->getSrcFilename()->shouldBe("RDM/Namespace/MyFeature.class.php");
        $this->getSpecFilename()->shouldBe("RDM/Namespace/MyFeatureSpec.class.php");

        $this->getSrcNamespace()->shouldBe("RDM\\Namespace");
        $this->getSpecNamespace()->shouldBe("RDM\\Namespace");
    }
}
