<?php
/**
 * Copyright © RVs Media, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Rvs\FreeShippingPromotionBar\Block;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ShippingPromotion extends Template
{

    /**
     * Constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get Shipping Configurations
     *
     * @param type $config
     */

    public function getShippingConfig($config)
    {
        return $this->scopeConfig->getValue(
            'rvs_freeshipping/general/'.$config,
            \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE
        );
    }
}
