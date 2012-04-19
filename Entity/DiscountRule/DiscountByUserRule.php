<?php

namespace MQM\PricingBundle\Entity\DiscountRule;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="mqm_pricing_discount_by_user_rule")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class DiscountByUserRule implements DiscountRuleInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    private $email;
    
    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime $modifiedAt
     *
     * @ORM\Column(name="modifiedAt", type="datetime", nullable=true)
     */
    private $modifiedAt;
    
    /**
     * @var float $discount
     *
     * @ORM\Column(name="discount", type="float", nullable=true)
     */
    private $discount;
    
    /**
     * @var \DateTime $start
     *
     * @ORM\Column(name="startDate", type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime $deadline
     *
     * @ORM\Column(name="deadline", type="datetime", nullable=true)
     */
    private $deadline;
    
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