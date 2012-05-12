<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\PriceCalculator\PriceCalculatorInterface;
use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculatorInterface;
use MQM\PricingBundle\Model\PriceRule\PriceRuleManagerInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Pricing\DiscountInterface;
use MQM\ProductBundle\Model\ProductInterface;

interface PricingManagerInterface
{
    /**
     * @param array
     * 
     * @return array
     */
    public function getProductsPrice(array $products);
    
    /**
     * @param ProductInterface
     * 
     * @return PriceInterface
     */
    public function getProductPrice(ProductInterface $product);
    
    /**
     * @param EventListener 
     */
    public function addPriceCalculator(PriceCalculatorInterface $priceCalculator);
    
    /**
     * @param EventListener 
     */
    public function addDiscountCalculator(DiscountCalculatorInterface $discountCalculator);
    
    /**
     *
     * @return PriceInterface 
     */
    public function createPrice();
    
    /**
     * @return DiscountInterface
     */
    public function createDiscount();
    
    /**
     * @param string 
     * @return PriceRuleManagerInterface
     */
    public function getPriceRuleManager($priceRuleClass = null);
    
    /**
     * @param string 
     * @return DiscountRuleManagerInterface
     */
    public function getDiscountRuleManager($discountRuleClass = null);
}