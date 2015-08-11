<?php

namespace RDM\PHPSpec;

use PhpSpec\ServiceContainer;

interface Assembler {

    public function build(ServiceContainer $container);

}