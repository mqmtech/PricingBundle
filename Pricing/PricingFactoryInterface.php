<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Pricing\DiscountInterface;

interface PricingFactoryInterface
{   
    
    /**
     * @return PriceInterface 
     */
    public function createPrice();
    
    /**
     * @return DiscountInterface
     */
    public function createDiscount();
}