<?php

namespace MQM\PricingBundle\FileSystem;

use MQM\ToolsBundle\IO\PropertiesInterface;

final class DiscountFilePropertiesFactory
{
    private $properties;
    private $propertiesPath;
    
    public function __construct(PropertiesInterface $properties, $propertyFilename)
    {
        $this->properties = $properties;                
        $this->propertiesPath = $propertyFilename;
    }
    
    public function createProperties()
    {
        $absolutePath = __DIR__ . '/../' . $this->propertiesPath;
        $this->properties->parse($absolutePath);
        
        return $this->properties;
    }
}