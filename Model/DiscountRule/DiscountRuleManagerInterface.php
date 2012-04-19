<?php

namespace MQM\PricingBundle\Model\DiscountRule;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleInterface;

interface DiscountRuleManagerInterface
{
    /**
     * @return DiscountRuleInterface
     */
    public function createDiscountRule();
    
    /**
     *
     * @param DiscountRuleInterface $discountRule
     * @param boolean $andFlush 
     */
    public function saveDiscountRule(DiscountRuleInterface $discountRule, $andFlush = true);
    
    /**
     *
     * @param DiscountRuleInterface $discountRule
     * @param boolean $andFlush 
     */
    public function deleteDiscountRule(DiscountRuleInterface $discountRule, $andFlush = true);
    
    /**
    * @return DiscountRuleManagerInterface
    */
    public function flush();
    
    /**
     * @param array $criteria
     * @return DiscountRuleInterface 
     */
    public function findDiscountRuleBy(array $criteria);
    
    /**
     * @return array 
     */
    public function findDiscountRules();
}