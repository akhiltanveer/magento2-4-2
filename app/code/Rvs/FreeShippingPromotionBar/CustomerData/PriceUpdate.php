<?php
namespace Rvs\FreeShippingPromotionBar\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\App\Helper\Context;

class PriceUpdate implements SectionSourceInterface
{
  /**
   * Constructor.
   *
   * @param Cart $cart
   * @param ShippingPromotion $shippingPromotion
   */
    public function __construct(
        \Magento\Checkout\Model\Cart $cart,
        \Rvs\FreeShippingPromotionBar\Block\ShippingPromotion $shippingPromotion
    ) {
        $this->shippingPromotion = $shippingPromotion;
        $this->cart = $cart;
    }

    /**
     * Get Section data
     *
     * @return array
     */
    public function getSectionData()
    {
        $moduleStatus = $this->shippingPromotion->getShippingConfig("enable_free_shipping");
        $shippingLimit = $this->shippingPromotion->getShippingConfig("shipping_limit");
        $cartTotal = $this->cart->getQuote()->getSubtotal();
        $message = $this->shippingPromotion->getShippingConfig("shipping_default_message");
        $limitMessage = $this->shippingPromotion->getShippingConfig("shipping_limit_message");
        $freeShippingMessage = $this->shippingPromotion->getShippingConfig("shipping_free_message");
        $currency = $this->shippingPromotion->getShippingConfig("currency");

        if ($cartTotal > 0 && $cartTotal < $shippingLimit) {
            $valueToAdd = $shippingLimit - $cartTotal;
            $valueToAdd = number_format($valueToAdd, 2, '.', ',');
            $message = __('Add ')." ".$currency.$valueToAdd." ".$limitMessage;
        }

        if ($cartTotal > $shippingLimit) {
            $message = $freeShippingMessage;
        }

        return [
            'modulestatus' => $moduleStatus,
            'message' => $message,
        ];
    }
}
