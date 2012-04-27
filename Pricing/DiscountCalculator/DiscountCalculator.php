<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculatorInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleInterface;

use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\ToolsBundle\Utils;
use Symfony\Component\Locale\Exception\NotImplementedException;

abstract class DiscountCalculator implements DiscountCalculatorInterface
{     
    /**
     * @param PriceInterface $price
     */
    public function addDiscountToPriceUsingDiscountRule(PriceInterface $price)
    {
        if ($this->isDiscountInValidDateNotNullAndGreaterThanZero()) {
            $discountValue = $this->getDiscountRule()->getDiscount();
            $discountNormalized = $this->normalizeDiscount($discountValue);
            $discountAbsoluteValue = (float) $price->getOriginalValue() * ($discountNormalized) ;
            $discount = $this->getPricingFactory()->createDiscount();
            $discount->setValue($discountAbsoluteValue);
            $discount->add('startDate', $this->getDiscountRule()->getStartDate());
            $discount->add('deadline', $this->getDiscountRule()->getDeadline());
            $price->addDiscount($discount);
        }
    }
    
    /**
     * @return boolean 
     */
    public function isDiscountInValidDateNotNullAndGreaterThanZero()
    {
        $discountValue = $this->getDiscountRule()->getDiscount();
        $startDate = $this->getDiscountRule()->getstartDate();
        $deadline = $this->getDiscountRule()->getDeadline();
        
        $startDate = Utils::getInstance()->convertDateTimeToTimeStamp($startDate);
        $deadline = Utils::getInstance()->convertDateTimeToTimeStamp($deadline);
        $currentTime = Utils::getInstance()->convertDateTimeToTimeStamp(new \DateTime());
        if ($currentTime > $startDate && $currentTime <  $deadline && $discountValue != null && $discountValue > 0) {
            return true;
        }    
        
        return false;
    }

    /**
     * @param float
     * @return float
     */
    public function normalizeDiscount($discount)
    {
        if ($discount > 1.0) {
            $discount = (float)$discount / 100.0;
        }

        return $discount;
    }
    
    /**
     * @return DiscountRuleInterface
     * @throws NotImplementedException 
     */
    protected abstract function getDiscountRule();
    
    /**
     * @return PricingFactoryInterface
     * @throws NotImplementedException 
     */
    protected abstract function getPricingFactory();
}