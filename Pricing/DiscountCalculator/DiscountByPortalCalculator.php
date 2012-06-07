<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;
use MQM\ToolsBundle\IO\PropertiesInterface;

class DiscountByPortalCalculator extends DiscountCalculator
{
    private $discountManager;
    private $priceFactory;
    private $discountRule;
    
    public function __construct(DiscountRuleManagerInterface $discountManager, $priceFactory)
    {
        $this->discountManager = $discountManager;
        $this->priceFactory = $priceFactory;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price)
    {
        $this->discountRule = $this->discountManager->findDiscountRuleBy(array());
        if ($this->discountRule != null) {
            return $this->addDiscountToPriceUsingDiscountRule($price, 9);
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
