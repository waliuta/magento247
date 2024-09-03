<?php
namespace Perspective\CustomWidget\Block\Widget;

use \Magento\Framework\View\Element\Template;
use \Magento\Widget\Block\BlockInterface;

class NewsletterSignup extends Template implements BlockInterface
{
    protected $_template = "widget/newsletter_signup.phtml";

    public function getStaticBlockHtml($identifier){
        $block = $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId($identifier)->toHtml();
        return $block;
    }

    /**
     * Retrieve form action url and set "secure" param to avoid confirm
     * message when we submit form from secure page to unsecure
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('newsletter/subscriber/new', ['_secure' => true]);
    }
    
}
