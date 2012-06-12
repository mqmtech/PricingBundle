<?php

namespace MQM\PricingBundle\FileSystem;

use MQM\ToolsBundle\IO\PropertiesInterface;

final class DiscountFilePropertiesFactory
{
    private $properties;
    private $propertiesPath;
    private $propertiesFallbackPath;
    
    public function __construct(PropertiesInterface $properties, $propertyFilename, $propertiesFallbackPath)
    {
        $this->properties = $properties;                
        $this->propertiesPath = $propertyFilename;
        $this->propertiesFallbackPath = $propertiesFallbackPath;
    }
    
    public function createProperties()
    {
        try {
            $absolutePath = __DIR__ . '/../' . $this->propertiesPath;
            $this->properties->parse($absolutePath);
        }
        catch (\Exception $e){
            $this->resetProperties();
            $this->properties->parse($absolutePath);
        }
        
        return $this->properties;
    }
    
    private function resetProperties()
    {
        $absolutePath = __DIR__ . '/../' . $this->propertiesFallbackPath;
        $contents = file_get_contents($absolutePath);
        
        $absolutePath = __DIR__ . '/../' . $this->propertiesPath;
        file_put_contents($absolutePath, $contents);
    }
}