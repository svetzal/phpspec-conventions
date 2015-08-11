<?php

use PhpSpec\ServiceContainer;

class LocatorAssembler implements Assembler {

    public function build(ServiceContainer $container) {
        echo "HELLO, WORLD!";
    }

}