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
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @return datetime 
     */
    public function getCreatedAt();

    /**
     * @param datetime $modifiedAt
     */
    public function setModifiedAt($modifiedAt);

    /**
     * @return datetime 
     */
    public function getModifiedAt();
}