<?php

namespace MQM\PricingBundle\Entity\DiscountRule;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="mqm_pricing_discount_by_category_rule")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class DiscountByCategoryRule implements DiscountRuleInterface
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
     * @var string $categoryId
     *
     * @ORM\Column(name="categoryId", type="string", nullable=true)
     */
    private $categoryId;
    
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
     * @var \DateTime $startDate
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
     * @return integer
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     *
     * @param integer $categoryId 
     */
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
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

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }
}