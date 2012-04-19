<?php

namespace MQM\PricingBundle\Model\PriceRule;

use MQM\PricingBundle\Model\PriceRule\PriceRuleInterface;

interface PriceRuleManagerInterface
{
    /**
     * @return PriceRuleInterface
     */
    public function createPriceRule();
            
    /**
     *
     * @param PriceRuleInterface $priceRule
     * @param boolean $andFlush 
     */
    public function savePriceRule(PriceRuleInterface $priceRule, $andFlush = true);
    
    /**
     *
     * @param PriceRuleInterface $priceRule
     * @param boolean $andFlush 
     */
    public function deletePriceRule(PriceRuleInterface $priceRule, $andFlush = true);   
    
    /**
    * @return PriceRuleManagerInterface
    */
    public function flush();
    
    /**
     * @param array $criteria
     * @return PriceRuleInterface 
     */
    public function findPriceRuleBy(array $criteria);
    
    /**
     * @return array 
     */
    public function findPriceRules();
    
    /**
     * @param string $productId
     */
    public function findPriceRuleByProductId($productId);
}