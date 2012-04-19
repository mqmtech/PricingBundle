<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\PricingFactoryInterface;

class PricingFactory implements PricingFactoryInterface
{   
    private $priceClass;
    private $discountClass;
    
    public function __construct($priceClass, $discountClass)
    {
        $this->priceClass = $priceClass;
        $this->discountClass = $discountClass;
    }
    
    /**
     * @return {@inheritDoc}
     */
    public function createPrice()
    {
        return new $this->priceClass();
    }
    
    /**
     * @return {@inheritDoc}
     */
    public function createDiscount()
    {
        return new $this->discountClass();
    }
}