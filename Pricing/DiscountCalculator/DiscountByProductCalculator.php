<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;

class DiscountByProductCalculator extends DiscountCalculator
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
        $this->discountRule = $this->discountRuleManager->findDiscountRuleBy(array('product' => $product->getId()));
        if ($this->discountRule != null) {
            return $this->addDiscountToPriceUsingDiscountRule($price, 6);
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getDiscountRule()
    {
        return $this->discountRule;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPricingFactory()
    {
        return $this->priceFactory;
    }
}