<?php

namespace MQM\PricingBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use MQM\PricingBundle\Pricing\PriceInterface;

class PricingHelper extends Helper
{
    protected $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    public function renderDiscountNames(PriceInterface $price, $parameters = array())
    {
        $parameters = $parameters + array(
            'separator' => '+'
        );
        $discounts = $price->getDiscounts();
        $discountNames = '';
        $count = 0;
        foreach ($discounts as $discount) {
            if ($count > 0) 
                $discountNames .= $parameters['separator'];
            
            $discountNames .= $discount->getName();
            $count++;
        }
        
        return $discountNames;
    }
    
    public function renderDiscountDeadline(PriceInterface $price, $parameters = array())
    {
        $parameters = $parameters + array(
            'separator' => '+'
        );
        $discounts = $price->getDiscounts();        
        $minDeadline = new \DateTime('today + 10 year');        
        $count = 0;
        foreach ($discounts as $discount) {
            $deadline = $discount->get('deadline');
            if ($deadline instanceof \DateTime && $deadline < $minDeadline){
                $minDeadline = $deadline;
                $count++;
            }                        
        }
        if ($count > 0) {
            $dateFormat = 'd-m-Y';
            return $minDeadline->format($dateFormat);
        }
        else {
            return 'indefinido';
        }       
    }

    /**
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return 'price_helper';
    }
}
