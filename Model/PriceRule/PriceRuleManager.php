<?php

namespace MQM\PricingBundle\Model\PriceRule;

use MQM\PricingBundle\Model\PriceRule\PriceRuleManagerInterface;

abstract class PriceRuleManager implements PriceRuleManagerInterface
{
    /**
     * {@inheritDoc} 
     */
    public function findPriceRuleByProductId($productId) {
        return $this->findPriceRuleBy(array('productId' => $productId));
    }
    
    /**
     * {@inheritDoc} 
     */
    public function findPriceRuleBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * {@inheritDoc} 
     */
    public function findPriceRules()
    {
        return $this->getRepository()->findAll();
    }
}