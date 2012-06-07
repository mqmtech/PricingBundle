<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\DiscountInterface;

class Discount implements DiscountInterface
{
    private $value;
    private $name;
    private $description;
    private $vars = array();
    
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
        
        return $this;
    }
    
    public function getVars()
    {
        return $this->vars;
    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }
    
    public function get($var)
    {
        if (isset($this->vars[$var])) {
            return $this->vars[$var];
        }
        
        return null;
    }
    
    public function add($var, $value)
    {
        $this->vars[$var] = $value;
        
        return $this;
    }
}