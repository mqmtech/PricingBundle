<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Pricing\DiscountInterface;
use MQM\ProductBundle\Model\ProductInterface;

interface DiscountCalculatorInterface
{   
    /**
     * @param string
     * @param PriceInterface
     */
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price);
}