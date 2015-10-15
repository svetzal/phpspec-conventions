<?php

namespace RDM\CustomSuffix;

use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\ServiceContainer;

class Extension implements ExtensionInterface {

    public function load(ServiceContainer $container) {
        $this->setupAutoloaders($container);
        $this->setupLocators($container);
    }

    /**
     * Adds autoloaders that can handle the class name extensions specified in each
     * phpspec suite.
     *
     * @param $container
     */
    private function setupAutoloaders(ServiceContainer $container) {
        $suites = $container->getParam('suites');
        foreach($suites as $suite => $config) {
            $srcPath = array_key_exists('src_path', $config) ? $config['src_path'] : 'src';
            $extension = array_key_exists('src_extension', $config) ? $config['src_extension'] : '.php';
            spl_autoload_register(function($class_name) use ($srcPath, $extension) {
                $filename = $srcPath . "/" . preg_replace('/\\\/', '/', $class_name) . $extension;
                if (file_exists($filename)) {
                    require_once($filename);
                }
            });
        }
    }

    /**
     * Set up Locator services for each phpspec suite configured, which may have
     * different class filename extensions.
     *
     * @param ServiceContainer $container
     */
    private function setupLocators(ServiceContainer $container) {
        $container->addConfigurator(function($c) {
            $suites = $c->getParam('suites');
            foreach($suites as $suite => $config) {
                // Not keen on how we have to track these config directives...
                $srcPath = $this->configParamOrDefault('src_path', $config, 'src');
                $specPath = $this->configParamOrDefault('spec_path', $config, '.');
                $srcNamespace = $this->configParamOrDefault('namespace', $config, '');
                $specNamespacePrefix = $this->configParamOrDefault('spec_prefix', $config, 'spec');
                $psr4Prefix = $this->configParamOrDefault('psr4_prefix', $config, null);
                $extension = $this->configParamOrDefault('src_extension', $config, '.php');

                $c->setShared('locator.locators.rdm.class_locator_'.$suite,
                    function($c) use ($srcNamespace, $specNamespacePrefix, $srcPath, $specPath, $psr4Prefix, $extension) {
                        $l = new SuffixablePSR0Locator($srcNamespace, $specNamespacePrefix, $srcPath, $specPath, null, $psr4Prefix, $extension);
                        return $l;
                    }
                );
            }

            $resourceManager = $c->get('locator.resource_manager');
            array_map(
                array($resourceManager, 'registerLocator'),
                $c->getByPrefix('locator.locators.rdm')
            );
        });
    }

    private function configParamOrDefault($param, $config, $default) {
        return array_key_exists($param, $config) ? $config[$param] : $default;
    }

}
