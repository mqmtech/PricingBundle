<?php

namespace MQM\PricingBundle\Pricing\PriceCalculator;

use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\ProductBundle\Model\ProductInterface;

interface PriceCalculatorInterface
{   
    /**
     * @param integer
     */
    public function calculatePrice(ProductInterface $product);
}