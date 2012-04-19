<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\DiscountInterface;

class Discount implements DiscountInterface
{   
    private $value;
    private $name;
    private $description;
    
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
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}