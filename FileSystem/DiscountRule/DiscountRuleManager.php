<?php

namespace MQM\PricingBundle\FileSystem\DiscountRule;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManagerInterface;
use MQM\PricingBundle\Model\DiscountRule\DiscountRuleInterface;
use MQM\ToolsBundle\IO\PropertiesInterface;

class DiscountRuleManager implements DiscountRuleManagerInterface
{
    private $discountProperties;
    private $discountRuleClass;

    public function __construct(PropertiesInterface $discountProperties, $discountRuleClass)
    {
        $this->discountProperties = $discountProperties;
        $this->discountRuleClass = $discountRuleClass;
    }

    /**
     * {@inheritDoc}
     */
    public function createDiscountRule()
    {
        return new $this->discountRuleClass();
    }

    /**
     * {@inheritDoc}
     */
    public function saveDiscountRule(DiscountRuleInterface $discountRule, $andFlush = true)
    {
        $this->saveDiscountRuleToFile($discountRule);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteDiscountRule(DiscountRuleInterface $discountRule, $andFlush = true)
    {
        $this->discountProperties->setProperty('discount', 0.0);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function flush()
    {
        $this->discountProperties->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function findDiscountRuleBy(array $criteria)
    {
        return $this->loadDiscountRuleFromFile();
    }

    /**
     * {@inheritDoc}
     */
    public function findDiscountRules()
    {
        $rule = $this->loadDiscountRuleFromFile();

        return array($rule);
    }

    private function saveDiscountRuleToFile(DiscountRuleInterface $discountRule)
    {
        $dateFormat = 'd-m-Y';
        $this->discountProperties->setProperty('discount', (float) $discountRule->getDiscount());
        $this->discountProperties->setProperty('startDate', $discountRule->getStartDate()->format($dateFormat));
        $this->discountProperties->setProperty('deadline', $discountRule->getDeadline()->format($dateFormat));
        $this->discountProperties->setProperty('createdAt', $discountRule->getCreatedAt()->format($dateFormat));
        $this->discountProperties->setProperty('modifiedAt', $discountRule->getModifiedAt()->format($dateFormat));
    }

    private function loadDiscountRuleFromFile()
    {
        /**
         * @var DiscountRuleInterface $rule
         */
        $rule = new $this->discountRuleClass();

        $discount = (float) $this->discountProperties->getProperty('discount');
        $startDateString = $this->discountProperties->getProperty('startDate');
        $deadlineString = $this->discountProperties->getProperty('deadline');
        $createdAtString = $this->discountProperties->getProperty('createdAt');
        $modifiedAtString = $this->discountProperties->getProperty('modifiedAt');

        $rule->setDiscount($discount);
        $rule->setStartDate(new \DateTime($startDateString));
        $rule->setDeadline(new \DateTime($deadlineString));
        $rule->setCreatedAt(new \DateTime($createdAtString));
        $rule->setModifiedAt(new \DateTime($modifiedAtString));

        return $rule;
    }
}