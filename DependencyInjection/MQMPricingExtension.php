<?php

namespace MQM\PricingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MQMPricingExtension extends Extension
{
    const BUNDLE_NS = 'mqm_pricing.';
    private $container;
    private $config;
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->container = $container;
        $configuration = new Configuration();
        $this->config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('orm.xml');
        $loader->load('services.xml');
        $this->loadConfig();
    }
    
    private function loadConfig()
    {
        $this->loadPriceConfig();
        $this->loadDiscoungPerProductConfig();
    }
    
    private function loadPriceConfig()
    {
        if (isset($this->config['price_default_calculator'])) {
            $priceDefaultCalculator = $this->config['price_default_calculator'];
            if (isset($priceDefaultCalculator['calculator_class'])) {
                $defaultCalculatorClass = $priceDefaultCalculator['calculator_class'];
                $this->container->setParameter(self::BUNDLE_NS . 'price_default_calculator.class', $defaultCalculatorClass);
            }            
            if (isset($priceDefaultCalculator['rule_class'])) {
                $defaultRuleClass = $priceDefaultCalculator['rule_class'];
                $this->container->setParameter(self::BUNDLE_NS . 'model.price_rule_default.class', $defaultRuleClass);
            }    
        }
    }
    
    private function loadDiscoungPerProductConfig()
    {
        if (isset($this->config['discount_per_product_calculator'])) {
            $priceDefaultCalculator = $this->config['discount_per_product_calculator'];
            if (isset($priceDefaultCalculator['calculator_class'])) {
                $defaultCalculatorClass = $priceDefaultCalculator['calculator_class'];
                $this->container->setParameter(self::BUNDLE_NS . 'discount_by_product_rule_calculator.class', $defaultCalculatorClass);
            }            
            if (isset($priceDefaultCalculator['rule_class'])) {
                $defaultRuleClass = $priceDefaultCalculator['rule_class'];
                $this->container->setParameter(self::BUNDLE_NS . 'model.discount_by_product_rule.class', $defaultRuleClass);
            }    
        }
    }
}
