<?php

namespace MQM\PricingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class CalculatorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('mqm_pricing.pricing_manager')) {
            return;
        }

        $definition = $container->getDefinition('mqm_pricing.pricing_manager');

        foreach ($container->findTaggedServiceIds('mqm_pricing.discount_calculator') as $id => $attributes) {
            $definition->addMethodCall('addDiscountCalculator', array(new Reference($id)));
        }
    }
}
