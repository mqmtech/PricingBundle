<?php

namespace MQM\PricingBundle\Model;

use MQM\PricingBundle\Model\PriceRule\PriceRuleManagerInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;

interface RuleManagerRegistryInterface
{
    /**
     * @param string
     * @return PriceRuleManagerInterface
     */
    public function getPriceRuleManager($priceRuleClass);
    
    /**
     * @param string
     * @return DiscountRuleManagerInterface
     */
    public function getDiscountRuleManager($discountRuleClass);
}