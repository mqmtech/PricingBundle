<?php

namespace MQM\PricingBundle\Entity\PriceRule;

use MQM\PricingBundle\Model\PriceRule\PriceRuleInterface;
use MQM\ProductBundle\Model\ProductInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 * @ORM\Table(name="mqm_pricing_price_default_rule")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class PriceRule implements PriceRuleInterface
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
     *
     * @var MQM\ProductBundle\Entity\Product $product 
     * 
     * @ORM\OneToOne(targetEntity="MQM\ProductBundle\Entity\Product")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id", nullable=true)
     * 
     */
    private $product;
    
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
     * @var float $price
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;
    
    /**
     * @var string $currencyCode
     *
     * @ORM\Column(name="currencyCode", type="string", nullable=true)
     */
    private $currencyCode;
    
    public function __construct(ProductInterface $product = null)
    {
        if ($product != null) {
            $this->product = $product;
        }
        $this->createdAt = new \DateTime();
    }
    
    /**
     * {@inheritDoc}
     */
    public function setProduct(ProductInterface $product)
    {
        $this->product = $product;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getProduct() {
        return $this->product;
    }
    
    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return '' . $this->getId();
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritDoc}
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }
}