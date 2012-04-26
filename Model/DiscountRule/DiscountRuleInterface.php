<?php

namespace MQM\PricingBundle\Model\DiscountRule;

interface DiscountRuleInterface
{
    /**
     * @param float $discount
     */
    public function setDiscount($discount);
    
    /**
     * @return float
     */
    public function getDiscount();

    /**
     * @param \DateTime
     */
    public function setStartDate($startDate);
    
    /**
     * @return \DateTime
     */
    public function getStartDate();
    
    /**
     * @param \DateTime
     */
    public function setDeadline($deadline);

    /**
     * @return \DateTime
     */
    public function getDeadline();    
    
    /**
     * @param \DateTime
     */
    public function setCreatedAt($createdAt);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime
     */
    public function setModifiedAt($modifiedAt);

    /**
     * @return \DateTime
     */
    public function getModifiedAt();
}