<?php

namespace MQM\PricingBundle\Model\DiscountRule;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;

abstract class DiscountRuleManager implements DiscountRuleManagerInterface
{
    /**
     * {@inheritDoc} 
     */
    public function findDiscountRuleBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * {@inheritDoc} 
     */
    public function findDiscountRules()
    {
        return $this->getRepository()->findAll();
    }
}