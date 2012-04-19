<?php

namespace MQM\PricingBundle\Test\Pricing;

use MQM\PricingBundle\Model\PriceRule\PriceRuleManagerInterface;
use MQM\PricingBundle\Pricing\PricingInterface;
use MQM\PricingBundle\Tests\Pricing\Helper\TestCalculator;
use MQM\PricingBundle\Event\PricingEvents;
use MQM\ProductBundle\Model\ProductManagerInterface;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\AppKernel;

class PriceRuleManagerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{   
    protected $_container;
    private $priceRuleManager;
    private $pricing;
    private $calculator;
    private $productManager;    
    private $product;

    public function __construct()
    {
        parent::__construct();
        
        $client = static::createClient();
        $container = $client->getContainer();
        $this->_container = $container;  
    }
    
    protected function setUp()
    {
        $this->pricing = $this->get('mqm_pricing.pricing_manager');
        $this->priceRuleManager = $this->pricing->getPriceRuleManager();
        $this->productManager = $this->get('mqm_product.product_manager');
        $this->calculator = new TestCalculator();
        $this->createTestProducts();        
    }

    protected function tearDown()
    {
        $this->resetPrices();
        $this->resetDiscounts();
        $this->resetProducts();
    }

    protected function get($service)
    {
        return $this->_container->get($service);
    }
    
    public function testGetPriceRuleManager()
    {
        $this->assertNotNull($this->priceRuleManager);
    }
    
    public function testCreatePriceRule()
    {
        $priceRuleManager = $this->pricing->getPriceRuleManager('\MQM\PricingBundle\Entity\PriceRule\PriceRule');
        $priceRule = $priceRuleManager->createPriceRule();
        $priceRule->setProduct($this->product);
        $this->assertNotNull($priceRule);
    }
    
    public function testPriceRuleManager()
    {
        $priceRule = $this->pricing->getPriceRuleManager('\MQM\PricingBundle\Entity\PriceRule\PriceRule')->createPriceRule();
        $priceRule->setProduct($this->product);
        $priceRule->setPrice(100.50);
        $this->priceRuleManager->savePriceRule($priceRule);
        
        $price = $this->pricing->getProductPrice($this->product);
        $this->assertNotNull($price);
        $this->assertEquals(100.50, $price->getValue());
    }
    
    public function testPricingEvents()
    {
        $priceRule = $this->pricing->getPriceRuleManager('\MQM\PricingBundle\Entity\PriceRule\PriceRule')->createPriceRule($this->product);
        $priceRule->setProduct($this->product);
        $priceRule->setPrice(100.0);
        $this->priceRuleManager->savePriceRule($priceRule);
        
        $this->pricing->addPriceCalculator($this->calculator);
        $price = $this->pricing->getProductPrice($this->product);
        $this->assertNotNull($price);
        $this->assertEquals(10.10, $price->getValue());
    }
    
    public function testDiscountEvents()
    {
        $priceRule = $this->pricing->getPriceRuleManager('\MQM\PricingBundle\Entity\PriceRule\PriceRule')->createPriceRule();
        $priceRule->setProduct($this->product);
        $priceRule->setPrice(100.0);
        $this->priceRuleManager->savePriceRule($priceRule);
                
        $this->pricing->addDiscountCalculator($this->calculator);
        $price = $this->pricing->getProductPrice($this->product);
        $this->assertNotNull($price);
        $discounts = $price->getDiscounts();
        
        $discount = $discounts[0];
        $this->assertEquals(1.5, $discount->getValue());
    }
    
    public function testDiscountWithRulebaseEvents()
    {
        $priceRule = $this->pricing->getPriceRuleManager('\MQM\PricingBundle\Entity\PriceRule\PriceRule')->createPriceRule();
        $priceRule->setProduct($this->product);
        $priceRule->setPrice(100.0);
        $this->priceRuleManager->savePriceRule($priceRule);
        
        $discountRuleManager = $this->pricing->getDiscountRuleManager('\MQM\PricingBundle\Entity\DiscountRule\DiscountByProductRule');
        $discountRule = $discountRuleManager->createDiscountRule();
        $discountRule->setProduct($this->product);
        $discountRule->setDiscount(2.0);
        $discountRuleManager->saveDiscountRule($discountRule);
                
        $this->pricing->addDiscountCalculator($this->calculator);
        $price = $this->pricing->getProductPrice($this->product);
        $this->assertNotNull($price);
        $discounts = $price->getDiscounts();
        
        $discount1 = $discounts[0];
        $discount2 = $discounts[1];        
        $this->assertEquals(2.0, $discount1->getValue());        
        $this->assertEquals(1.5, $discount2->getValue());
        $this->assertEquals(96.5, $price->getValue());
        $this->assertEquals(3.5, $price->getTotalDiscountsValue());
        $this->assertLessThan(0.00001, 3.5 - $price->getTotalDiscountsPercetageValue());
    }
    
    private function createTestProducts()
    {
        $this->product = new \MQM\ProductBundle\Entity\Product();
        $this->productManager->saveProduct($this->product);        
    }
    
    private function resetPrices()
    {
        $prices = $this->priceRuleManager->findPriceRules();
        foreach ($prices as $price) {
            $this->priceRuleManager->deletePriceRule($price);
        }
    }
    
    private function resetDiscounts()
    {
        $discountRuleManager = $this->pricing->getDiscountRuleManager('\MQM\PricingBundle\Entity\DiscountRule\DiscountByProductRule');
        $discounts = $discountRuleManager->findDiscountRules();
        foreach ($discounts as $discountRule) {
            $discountRuleManager->deleteDiscountRule($discountRule);
        }
    }
    
    private function resetProducts()
    {
        $products = $this->productManager->findProducts();
        foreach ($products as $product) {
            $this->productManager->deleteProduct($product);
        }
    }
}
