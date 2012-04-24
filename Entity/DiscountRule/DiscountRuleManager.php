<?php

namespace MQM\PricingBundle\Entity\DiscountRule;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleManager as BaseDiscountRuleManager;

use MQM\PricingBundle\Model\DiscountRule\DiscountRuleInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DiscountRuleManager extends BaseDiscountRuleManager
{
    private $entityManager;
    private $discountClass;
   
    public function __construct(EntityManager $entityManager, $discountClass)
    {
        $this->entityManager = $entityManager;
        $this->discountClass = $discountClass;
    }
    
    /**
     * {@inheritDoc} 
     */
    public function createDiscountRule()
    {
        return new $this->discountClass();
    }
    
    /**
     * {@inheritDoc} 
     */
    public function saveDiscountRule(DiscountRuleInterface $discountRule, $andFlush = true)
    {
        $this->getEntityManager()->persist($discountRule);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc} 
     */
    public function deleteDiscountRule(DiscountRuleInterface $discountRule, $andFlush = true)
    {
        $this->getEntityManager()->remove($discountRule);
        if ($andFlush) {
            $this->getEntityManager()->flush();
        }
    }
    
    /**
     * {@inheritDoc} 
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
        
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
        return $this->entityManager->getRepository($this->discountClass);
    }
}