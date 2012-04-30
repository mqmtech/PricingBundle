<?php

namespace MQM\PricingBundle\Entity\DiscountRule;

use MQM\PricingBundle\Entity\DiscountRule\DiscountRule;
use MQM\ProductBundle\Model\ProductInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 * @ORM\Table(name="mqm_pricing_discount_by_product_rule")
 * @ORM\Entity
 */
class DiscountByProductRule extends DiscountRule
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
     *
     * @var MQM\ProductBundle\Entity\Product $product 
     * 
     * @ORM\OneToOne(targetEntity="MQM\ProductBundle\Entity\Product")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id", nullable=true)
     * 
     */
    protected $product;

    public function __construct(ProductInterface $product = null)
    {        
        if ($product != null) {
            $this->product = $product;
        }
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
     * @return ProductInterface
     */
    public function getProduct() {
        return $this->product;
    }

    /**
     * @param ProductInterface
     */
    public function setProduct(ProductInterface $product) {
        $this->product = $product;
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