<?php

namespace MQM\PricingBundle\Tests\Pricing\Helper;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculatorInterface;
use MQM\PricingBundle\Pricing\PriceCalculator\PriceCalculatorInterface;
use MQM\PricingBundle\Pricing\Price;
use MQM\PricingBundle\Pricing\Discount;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\ProductBundle\Model\ProductInterface;

class TestCalculator implements DiscountCalculatorInterface, PriceCalculatorInterface
{   
    public function calculatePrice(ProductInterface $product)
    {
        $price = new Price();
        $price->setValue(10.10);        
        
        return $price;
    }
    
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price)
    {
        $discount = new Discount();
        $discount->setValue(1.5);
        $price->addDiscount($discount);          
    }
}
