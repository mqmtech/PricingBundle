<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\DiscountInterface;

interface PriceInterface
{   
    /**
     * @param float 
     */
    public function setValue($value);
    
    /**
     * @return float 
     */
    public function getValue();
    
    /**
     * @return float 
     */
    public function getOriginalValue();
    
    /**
     * @return boolean 
     */
    public function hasDiscounts();
    
    /**
     * @return float 
     */
    public function getTotalDiscountsValue();
    
    /**
     * @return float 
     */
    public function getTotalDiscountsPercetageValue();
    
    /**
     * @param array
     */
    public function setDiscounts($discounts);
    
    /**
     * @param DiscountInterface 
     */
    public function addDiscount(DiscountInterface $discount);
    
    /**
     * @return array 
     */
    public function getDiscounts();
}