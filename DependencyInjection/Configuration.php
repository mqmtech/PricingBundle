<?php

namespace MQM\PricingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mqm_pricing');

        $rootNode
            ->children()
                ->scalarNode('allow_price_calculators')->defaultValue(false)->end()     // Allow many ways to calculate the price by adding implementation of PriceCalcultator interface
                ->arrayNode('price_default_calculator')
                    ->children()
                    ->scalarNode('calculator_class')->defaultValue(null)->end()
                    ->scalarNode('rule_class')->defaultValue(null)->end()
                    ->end()
                ->end()
                ->scalarNode('allow_discount_calculators')->defaultValue(true)->end()   // Allow many ways to calculate the discount by adding implementations of the DiscountCalculator interface
                ->arrayNode('discount_per_product_calculator')
                    ->children()
                    ->scalarNode('calculator_class')->defaultValue(null)->end()
                    ->scalarNode('rule_class')->defaultValue(null)->end()
                    ->end()
                ->end()
                ->arrayNode('discount_per_user_calculator')
                    ->children()
                    ->scalarNode('calculator_class')->defaultValue(null)->end()
                    ->scalarNode('rule_class')->defaultValue(null)->end()
                    ->end()
                ->end()
                ->arrayNode('discount_per_time_calculator')
                    ->children()
                    ->scalarNode('calculator_class')->defaultValue(null)->end()
                    ->scalarNode('rule_class')->defaultValue(null)->end()
                    ->end()
                ->end()
                ->arrayNode('discount_per_category_calculator')
                    ->children()
                    ->scalarNode('calculator_class')->defaultValue(null)->end()
                    ->scalarNode('rule_class')->defaultValue(null)->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
