<?php

namespace MQM\PricingBundle\Entity\PriceRule;

use MQM\PricingBundle\Model\PriceRule\PriceRuleManager as BasePriceRuleManager;
use MQM\PricingBundle\Model\PriceRule\PriceRuleManagerInterface;
use MQM\PricingBundle\Model\PriceRule\PriceRuleInterface;
use MQM\ProductBundle\Model\ProductInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class PriceRuleManager extends BasePriceRuleManager
{
    private $priceRuleClass;
    private $entityManager;    
   
    public function __construct(EntityManager $entityManager, $priceRuleClass)
    {
        $this->entityManager = $entityManager;
        $this->priceRuleClass = $priceRuleClass;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createPriceRule()
    {
        return new $this->priceRuleClass();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function savePriceRule(PriceRuleInterface $priceRule, $andFlush = true)
    {
        $this->getEntityManager()->persist($priceRule);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc} 
     */
    public function deletePriceRule(PriceRuleInterface $priceRule, $andFlush = true)
    {
        $this->getEntityManager()->remove($priceRule);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc} 
     */
    public function flush()
    {
        return $this->getEntityManager()->flush();
        
        return $this;
    }
     
    /**
     *
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     *
     * @return EntityRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository($this->priceRuleClass);        
    }
}