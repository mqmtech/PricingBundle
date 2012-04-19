<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\ProductBundle\Model\ProductInterface;

class DiscountByTimeCalculator extends DiscountCalculator
{   
    private $discountRuleManager;
    private $priceFactory;
    private $discountRule;
    
    public function __construct(DiscountRuleManagerInterface $discountRuleManager, PricingFactoryInterface $priceFactory)
    {
        $this->discountRuleManager = $discountRuleManager;
        $this->priceFactory = $priceFactory;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price)
    {
        //TODO: Get Rule for the whole portal maybe from a file instead from database?
        $portalId = 1;
        $this->discountRule = $this->discountRuleManager->findDiscountRuleBy(array('id' => $portalId));
        if ($this->discountRule != null) {
            return $this->addDiscountToPriceUsingDiscountRule($price);
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getPricingFactory()
    {
        return $this->priceFactory;
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getDiscountRule()
    {
        return $this->discountRule;
    }
}