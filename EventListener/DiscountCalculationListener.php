<?php

namespace MQM\PricingBundle\EventListener;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculatorInterface;
use MQM\PricingBundle\Event\GetPriceEvent;

class DiscountCalculationListener
{
    private $discountCalculator;
    private $price;
    private $product;

    public function __construct(DiscountCalculatorInterface $discountCalculator)
    {
        $this->discountCalculator = $discountCalculator;
    }

    public function onDiscountCalculation(GetPriceEvent $event)
    {
        $this->product = $event->getProduct();
        $this->price = $event->getPrice();
        if ($this->price != null) {
            $this->discountCalculator->addDiscountToPrice($this->product, $this->price);
        }
    }
}