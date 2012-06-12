<?php

namespace MQM\PricingBundle\Twig\Extension;

use MQM\PricingBundle\Templating\Helper\PricingHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use MQM\PricingBundle\Pricing\PriceInterface;

class PricingExtension extends \Twig_Extension
{
    protected $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Returns a list of global functions to add to the existing list.
     *
     * @return array An array of global functions
     */
    public function getFunctions()
    {
        return array(
            'mqm_pricing_discount_names' => new \Twig_Function_Method($this, 'renderDiscountNames', array('is_safe' => array('html'))),
            'mqm_pricing_discount_deadline' => new \Twig_Function_Method($this, 'renderDiscountDeadline', array('is_safe' => array('html'))),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'mqm_pricing';
    }

    public function renderDiscountNames(PriceInterface $price, $parameters = array())
    {
        return $this->container->get('mqm_pricing.templating.helper')->renderDiscountNames($price, $parameters);
    }
    
    public function renderDiscountDeadline(PriceInterface $price, $parameters = array())
    {
        return $this->container->get('mqm_pricing.templating.helper')->renderDiscountDeadline($price, $parameters);
    }
}
