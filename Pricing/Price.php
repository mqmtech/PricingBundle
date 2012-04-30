<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Pricing\DiscountInterface;
use Symfony\Component\Form\Exception\NotValidException;

class Price implements PriceInterface
{   
    private $discounts;
    private $value;
    
    public function __construct()
    {
        $this->discounts = array();
    }
    
    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->getValue() . '';
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDiscounts($discounts)
    {
        $this->discounts = $discounts;
        
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addDiscount(DiscountInterface $discount)
    {
        if ($this->discounts == null) {
            $this->discounts = array();
        }
        $this->discounts[] = $discount;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
        
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        $priceValue = $this->getOriginalValue() - $this->getTotalDiscountsValue();
        if ($priceValue < 0.0) {
            throw NotValidException('$priceValue is less than zero in getValue function from class Price');
        }
        
        return $priceValue;
    }

    /**
     * {@inheritDoc}
     */
    public function getOriginalValue()
    {
        return $this->value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasDiscounts()
    {
        if ($this->discounts == null)
            return false;
        
        return count($this->discounts) > 0;
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalDiscountsPercentageValue()
    {
        if ($this->getOriginalValue() < 0.0000001) {
            //throw new \Exception('original value is zero');
            return 0;
        }
        $totalDiscountsValue = (float) $this->getTotalDiscountsValue();
        
        return ((float) $totalDiscountsValue / (float) $this->getOriginalValue()) * (float) 100.0;
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalDiscountsValue()
    {
        $totalDiscountsValue = (float) 0.0;
        foreach ($this->discounts as $discount) {
            $totalDiscountsValue += (float) $discount->getValue();
        }
        
        return $totalDiscountsValue;
    }
}