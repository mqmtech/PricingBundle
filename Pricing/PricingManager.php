<?php

namespace MQM\PricingBundle\Pricing;

use MQM\PricingBundle\Pricing\PricingManagerInterface;
use MQM\PricingBundle\Pricing\PriceCalculator\PriceCalculatorInterface;
use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculatorInterface;
use MQM\PricingBundle\Event\GetPriceEvent;
use MQM\PricingBundle\Event\PricingEvents;
use MQM\PricingBundle\EventListener\DiscountCalculationListener;
use MQM\PricingBundle\EventListener\PriceCalculationListener;
use MQM\PricingBundle\Model\RuleManagerRegistryInterface;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\ProductBundle\Model\ProductInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PricingManager implements PricingManagerInterface
{
    private $defaultPriceCalculator;
    private $eventDispatcher;        
    private $pricingFactory;
    private $managerRegistry;
    
    public function __construct(PriceCalculatorInterface $defaultPriceCalculator, EventDispatcherInterface $eventDispatcher, PricingFactoryInterface $pricingFactory, RuleManagerRegistryInterface $managerRegistry)
    {
        $this->defaultPriceCalculator = $defaultPriceCalculator;
        $this->eventDispatcher = $eventDispatcher;        
        $this->pricingFactory = $pricingFactory;
        $this->managerRegistry = $managerRegistry;        
    }
    
    /**
     * {@inheritDoc} 
     */
    public function getProductsPrice(array $products)
    {
        if ($products == null) {
            return null;
        }
        $prices = array();
        foreach ($products as $product) {
            $price = $this->getProductPrice($product);
            $prices[$product->getId()] = $price;
        }
        
        return $prices;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function getProductPrice(ProductInterface $product)
    {
        $event = new GetPriceEvent($product);
        $this->eventDispatcher->dispatch(PricingEvents::onPriceCalculation, $event);
        $price = $event->getPrice();
        if ($price == null) {
            $price = $this->defaultPriceCalculator->calculatePrice($product);
        }
        if ($price != null) {
            $event->setPrice($price);
            $this->eventDispatcher->dispatch(PricingEvents::onDiscountCalculation, $event);        
        }
        else {
            $price = $this->pricingFactory->createPrice(); //Special Case Pattern
        }

        return $price;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function addPriceCalculator(PriceCalculatorInterface $priceCalculator)
    {
        $eventDispatcher = $this->eventDispatcher;
        $listener = new PriceCalculationListener($priceCalculator);
        $eventDispatcher->addListener(PricingEvents::onPriceCalculation, array($listener, 'onPriceCalculation'));
    }
    
    /**
     * {@inheritDoc} 
     */
    public function addDiscountCalculator(DiscountCalculatorInterface $discountCalculator)
    {
        $eventDispatcher = $this->eventDispatcher;
        $listener = new DiscountCalculationListener($discountCalculator);
        $eventDispatcher->addListener(PricingEvents::onDiscountCalculation, array($listener, 'onDiscountCalculation'));
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createPrice()
    {
        return $this->pricingFactory->createPrice();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createDiscount()
    {
        return $this->pricingFactory->createDiscount();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function getPriceRuleManager($priceRuleClass = null)
    {
        return $this->managerRegistry->getPriceRuleManager($priceRuleClass);
    }
    
    /**
     * {@inheritDoc} 
     */
    public function getDiscountRuleManager($discountRuleClass = null)
    {
        return $this->managerRegistry->getDiscountRuleManager($discountRuleClass);
    }
}