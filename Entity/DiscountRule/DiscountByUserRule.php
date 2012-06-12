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

    /**
     * @var float $extraDiscount
     *
     * @ORM\Column(name="extraDiscount", type="float", nullable=true)
     */
    protected $extraDiscount;

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
        $name = '' . ($this->discount * 100);
        if ($this->extraDiscount > 0) {
            $name .= '+' . ($this->extraDiscount * 100);
        }
        
        return $name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param float $extraDiscount
     */
    public function setExtraDiscount($extraDiscount)
    {
        $this->extraDiscount = $extraDiscount;
    }

    /**
     * @return float
     */
    public function getExtraDiscount()
    {
        return $this->extraDiscount;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}