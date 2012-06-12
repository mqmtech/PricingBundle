<?php

namespace MQM\PricingBundle\Pricing\DiscountCalculator;

use MQM\PricingBundle\Pricing\DiscountCalculator\DiscountCalculator;
use MQM\PricingBundle\Pricing\PricingFactoryInterface;
use MQM\PricingBundle\Pricing\PriceInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\ProductBundle\Model\ProductInterface;
use MQM\UserBundle\Helper\UserAuthenticatedResolverInterface;
use MQM\PricingBundle\Entity\DiscountRule\DiscountByUserRule;

class DiscountByUserCalculator extends DiscountCalculator
{
    private $discountRuleManager;
    private $priceFactory;
    /**
     * @var DiscountByUserRule
     */
    private $discountRule;
    private $userResolver;
    
    public function __construct(DiscountRuleManagerInterface $discountRuleManager, UserAuthenticatedResolverInterface $userResolver, PricingFactoryInterface $priceFactory)
    {
        $this->discountRuleManager = $discountRuleManager;
        $this->priceFactory = $priceFactory;
        $this->userResolver = $userResolver;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addDiscountToPrice(ProductInterface $product, PriceInterface $price)
    {
        $user = $this->userResolver->getCurrentUser();
        if (!$this->userResolver->isLoggedIn($user)) {
            return;
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

            $extraDiscountValue = $this->getDiscountRule()->getExtraDiscount();
            $extraDiscountNormalized = $this->normalizeDiscount($extraDiscountValue);

            $totalDiscountNormalized = ($discountNormalized + ($extraDiscountNormalized * $discountNormalized));
            $totalDiscountAbsoluteValue = (float) $price->getOriginalValue() * ($totalDiscountNormalized);

            $discount = $this->getPricingFactory()->createDiscount();
            $discount->setValue($totalDiscountAbsoluteValue);
            $discount->add('startDate', $this->getDiscountRule()->getStartDate());
            $discount->add('deadline', $this->getDiscountRule()->getDeadline());
            $discount->setName($this->getDiscountRule());
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