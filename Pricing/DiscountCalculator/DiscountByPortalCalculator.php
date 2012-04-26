<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;

class DiscountByPortalCalculator implements DiscountCalculatorInterface
{   
    private $priceFactory;
    
    public function __construct(PricingFactoryInterface $priceFactory)
    {
        $this->priceFactory = $priceFactory;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price)
    {
        $discountPercentageValue = $this->getDiscountValueFromFileProperties();
        $discountAbsoluteValue = (float) $price->getValue() * ($discountPercentageValue / 100.0) ;
        $discount = $this->priceFactory->createDiscount();
        $discount->setValue($discountAbsoluteValue);
        $discount->add('deadline', new \DateTime('today + 4 year'));
        
        $price->addDiscount($discount);
    }
    
    private function getDiscountValueFromFileProperties()
    {
        return 50;
    }
}
