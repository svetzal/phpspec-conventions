<?php

namespace RDM\PHPSpec;

use PhpSpec\ServiceContainer;

class LocatorAssembler implements Assembler {

    public function build(ServiceContainer $container) {
        $assembler = $this;
        $container->addConfigurator(function($c) use ($assembler) {

//            $filesystem = $c->get('filesystem');
//            echo "HELLO!\n" . print_r($filesystem) . "\n";

            $c->setShared('locator.locators.class_locator',
                function($c) {
                    return new ClassLocator();
                }
            );
        });
    }

}