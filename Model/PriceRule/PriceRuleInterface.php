<?php

namespace MQM\PricingBundle\Model\PriceRule;

use MQM\ProductBundle\Model\ProductInterface;

interface PriceRuleInterface
{
    /**
     * @param float $price
     */
    public function setPrice($price);
    
    /**
     * @return float
     */
    public function getPrice();
    
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
    
    /**
     * @return ProductInterface 
     */
    public function getProduct();
    
    /**
     * @param ProductInterface 
     */
    public function setProduct(ProductInterface $product);
    
    /**
     * @return string
     */
    public function getCurrencyCode();

    /**
     * @param string 
     */
    public function setCurrencyCode($currencyCode);
}