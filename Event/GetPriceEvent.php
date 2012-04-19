<?php

namespace MQM\PricingBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\ProductBundle\Model\ProductInterface;

class GetPriceEvent extends Event
{
    private $product;
    private $price;
    
    public function __construct(ProductInterface $product, PriceInterface $price = null)
    {
        $this->product = $product;
        $this->price = $price;
    }

    /**
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     *
     * @return PriceInterface
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
    *
    * @param PriceInterface $price 
    */    
    public function setPrice(PriceInterface $price)
    {
        $this->price = $price;
    }
}