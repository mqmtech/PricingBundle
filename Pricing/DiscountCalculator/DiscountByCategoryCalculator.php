<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\ProductBundle\Model\ProductManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;


class DiscountByCategoryCalculator extends DiscountCalculator
{   
    private $discountRuleManager;
    private $priceFactory;
    private $productManager;    
    private $discountRule;
    
    public function __construct(DiscountRuleManagerInterface $discountRuleManager, PricingFactoryInterface $priceFactory, ProductManagerInterface $productManager)
    {
        $this->discountRuleManager = $discountRuleManager;
        $this->priceFactory = $priceFactory;
        $this->productManager = $productManager;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price)
    {
        $category = $product->getcategory();
        if ($category == null)
            return;
        
        $categoryId = $category->getId();
        
        if ($categoryId == null)
           return; 
        
        $this->discountRule = $this->discountRuleManager->findDiscountRuleBy(array('categoryId' => $categoryId));
        if ($this->discountRule != null) {
            return $this->addDiscountToPriceUsingDiscountRule($price);
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