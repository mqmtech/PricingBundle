<?php

namespace MQM\PricingBundle\Pricing\PriceCalculator;

use MQM\PricingBundle\Pricing\PriceCalculator\PriceCalculatorInterface;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Model\PriceRule\PriceRuleManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;

class PriceDefaultCalculator implements PriceCalculatorInterface
{
    private $priceRuleManager;
    private $priceFactory;
    
    public function __construct(PriceRuleManagerInterface $priceRuleManager, PricingFactoryInterface $priceFactory)
    {
        $this->priceRuleManager = $priceRuleManager;
        $this->priceFactory = $priceFactory;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function calculatePrice(ProductInterface $product)
    {
        $priceRule = $this->priceRuleManager->findPriceRuleBy(array('product' => $product->getId()));
        if ($priceRule !=null) {
            $priceValue = $priceRule->getPrice();
            $price = $this->priceFactory->createPrice();
            $price->setValue($priceValue);
            
            return $price;
        }
        else {
            return null;
        }
    }
}