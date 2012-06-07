<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\ProductBundle\Model\ProductManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;

class DiscountByBrandCalculator extends DiscountCalculator
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
        $brand = $product->getBrand();
        if ($brand == null)
            return;
        
        $brandId = $brand->getId();        
        if ($brandId == null)
           return; 
        
        $this->discountRule = $this->discountRuleManager->findDiscountRuleBy(array('brandId' => $brandId));
        if ($this->discountRule != null) {
            return $this->addDiscountToPriceUsingDiscountRule($price, 7);
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