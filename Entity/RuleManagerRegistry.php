<?php

namespace MQM\PricingBundle\Entity;

use MQM\PricingBundle\Model\RuleManagerRegistryInterface;
use Symfony\Component\Form\Exception\CreationException;
use Doctrine\ORM\EntityManager;

class RuleManagerRegistry implements RuleManagerRegistryInterface
{
    private $entityManager;    
    private $priceRuleManagerClass;
    private $priceRuleManagers = array();
    private $discountRuleManagerClass;
    private $discountRuleManagers = array();
    private $defaultPriceRuleClass;
   
    public function __construct(EntityManager $entityManager, $priceRuleManagerClass, $discountRuleManagerClass, $defaultPriceRuleClass = null)
    {
        $this->entityManager = $entityManager;
        $this->priceRuleManagerClass = $priceRuleManagerClass;
        $this->discountRuleManagerClass = $discountRuleManagerClass;
        $this->defaultPriceRuleClass = $defaultPriceRuleClass;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPriceRuleManager($priceRuleClass)
    {
        $priceRuleClass = $priceRuleClass == null ? $this->defaultPriceRuleClass : $priceRuleClass;
        if ($priceRuleClass == null) {
            throw new CreationException('PriceRuleClass needs to be specified in order to create PriceRuleManager in RuleManagerRegistry->getPriceRuleManager');
        }
        if (isset($this->priceRuleManagers[$priceRuleClass])) {
            return $this->priceRuleManagers[$priceRuleClass];
        }
        $priceRuleManager = new $this->priceRuleManagerClass($this->entityManager, $priceRuleClass);
        $this->priceRuleManagers[$priceRuleClass] = $priceRuleManager;
        
        return $priceRuleManager;
    }    
    
    /**
     * {@inheritDoc}
     */
    public function getDiscountRuleManager($discountRuleClass) {
        if ($discountRuleClass == null) {
            throw new CreationException('DiscountRuleClass needs to be specified in order to create DiscountRuleManager in RuleManagerRegistry->getDiscountRuleManager');
        }
        if (isset($this->discountRuleManagers[$discountRuleClass])) {
            return $this->discountRuleManagers[$discountRuleClass];
        }
        $discountRuleManager = new $this->discountRuleManagerClass($this->entityManager, $discountRuleClass);
        $this->discountRuleManagers[$discountRuleClass] = $discountRuleManager;
        
        return $discountRuleManager;
    }
}