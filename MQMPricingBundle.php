<?php

namespace MQM\PricingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use MQM\PricingBundle\DependencyInjection\Compiler\CalculatorCompilerPass;

class MQMPricingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CalculatorCompilerPass());
    }
}
