<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;
use MQM\UserBundle\Model\UserManagerInterface;
use MQM\PricingBundle\Entity\DiscountRule\DiscountByUserRule;

class DiscountByUserCalculator extends DiscountCalculator
{
    private $discountRuleManager;
    private $priceFactory;
    /**
     * @var DiscountByUserRule
     */
    private $discountRule;
    private $userManager;
    
    public function __construct(DiscountRuleManagerInterface $discountRuleManager, UserManagerInterface $userManager, PricingFactoryInterface $priceFactory)
    {
        $this->discountRuleManager = $discountRuleManager;
        $this->priceFactory = $priceFactory;
        $this->userManager = $userManager;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price)
    {
        $user = $this->userManager->getCurrentUser();
        if (!$this->userManager->isDBUser($user)) {
            return;
        }
        else {
            $user = $this->userManager->refreshUser($user);
        }
        $email = $user->getEmail();

        $this->discountRule = $this->discountRuleManager->findDiscountRuleBy(array('email' => $email));
        if ($this->discountRule != null) {
            return $this->addDiscountToPriceUsingDiscountRule($price, 10);
        }
        else {
            return null;
        }
    }

    /**
     * @param PriceInterface $price
     */
    public function addDiscountToPriceUsingDiscountRule(PriceInterface $price, $priority = null)
    {
        if ($this->isDiscountInValidDateNotNullAndGreaterThanZero()) {
            $discountValue = $this->getDiscountRule()->getDiscount();
            $discountNormalized = $this->normalizeDiscount($discountValue);

            $extraDiscountRule = $this->getDiscountRule()->getExtraDiscount();
            $extraDiscountNormalized = $this->normalizeDiscount($extraDiscountRule);

            $totalDiscountNormalized = ($discountNormalized + ($extraDiscountNormalized * $discountNormalized));
            $totalDiscountAbsoluteValue = (float) $price->getOriginalValue() * ($totalDiscountNormalized);

            $discount = $this->getPricingFactory()->createDiscount();
            $discount->setValue($totalDiscountAbsoluteValue);
            $discount->add('startDate', $this->getDiscountRule()->getStartDate());
            $discount->add('deadline', $this->getDiscountRule()->getDeadline());
            $discount->add('shortDescription', $discountNormalized . ' + ' . $extraDiscountNormalized);
            $price->addDiscount($discount, $priority);
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getPricingFactory()
    {
        return $this->priceFactory;
    }
    
    /**
     * @return DiscountByUserRule
     */
    protected function getDiscountRule()
    {
        return $this->discountRule;
    }
}