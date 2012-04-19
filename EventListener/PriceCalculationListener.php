<?php

namespace MQM\PricingBundle\EventListener;

use MQM\PricingBundle\Pricing\PriceCalculator\PriceCalculatorInterface;
use MQM\PricingBundle\Event\GetPriceEvent;

class PriceCalculationListener
{
    private $priceCalculator;
    
    public function __construct(PriceCalculatorInterface $priceCalculator)
    {
        $this->priceCalculator = $priceCalculator;
    }

    public function onPriceCalculation(GetPriceEvent $event)
    {
        $product = $event->getProduct();
        $price = $this->priceCalculator->calculatePrice($product);
        if ($price != null) {
            $event->setPrice($price);
            $event->stopPropagation();
        }
    }
}