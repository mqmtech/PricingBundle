<?php

namespace MQM\PricingBundle\Pricing;

interface DiscountInterface
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
     * @param string 
     */
    public function setName($name);
    
    /**
     * @return string
     */
    public function getName();    
    
    /**
     * @param string
     */
    public function setDescription($description);
    
    /**
     * @return string 
     */
    public function getDescription();
}