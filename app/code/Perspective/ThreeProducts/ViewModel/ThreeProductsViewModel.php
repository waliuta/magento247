<?php
namespace Perspective\ThreeProducts\ViewModel;

class ThreeProductsViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    public function __construct(
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->registry = $registry;
    }

    public function getCurrentProduct()
    {        
        return $this->registry->registry('current_product');
    }

    public function getCurrentCategory()
    {        
        return $this->registry->registry('current_category');
    }

}



