<?php

namespace MQM\PricingBundle\Entity\DiscountRule;

use MQM\PricingBundle\Entity\DiscountRule\DiscountRule;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 * @ORM\Table(name="mqm_pricing_discount_by_user_rule")
 * @ORM\Entity
 */
class DiscountByUserRule extends DiscountRule
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    protected $email;

    public function __construct()
    {        
        $this->createdAt = new \DateTime();
        $this->startDate = new \DateTime('today');
        $this->deadline = new \DateTime('today + 4 year');
    }
    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @param string $email 
     */
    public function setEmail($email)
    {
        $this->username = $email;
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
    public function getStartDate()
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