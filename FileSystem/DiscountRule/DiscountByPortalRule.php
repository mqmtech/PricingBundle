<?php

namespace MQM\PricingBundle\FileSystem\DiscountRule;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleInterface;

class DiscountByPortalRule implements DiscountRuleInterface
{
    private $createdAt;
    private $modifiedAt;
    private $discount;
    private $startDate;
    private $deadline;
    
    public function __construct()
    {        
        $this->createdAt = new \DateTime();
        $this->startDate = new \DateTime('today');
        $this->deadline = new \DateTime('today + 4 year');
    }

    public function __toString()
    {
        if ($this->discount == 0) {
            return '0';
        }

        return '' . ($this->discount * 100);
    }
    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * {@inheritDoc}
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * {@inheritDoc}
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * {@inheritDoc}
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * {@inheritDoc}
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getstartDate()
    {
        return $this->startDate;
    }

    /**
     * {@inheritDoc}
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * {@inheritDoc}
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * {@inheritDoc}
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }
}