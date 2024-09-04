<?php
namespace Perspective\ThreeProducts\ViewModel;

class ThreeProductsViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Block\Product\View
     */
    private $viewproduct;

    public function __construct(

        \Magento\Catalog\Block\Product\View $viewproduct
    )
    {

        $this->viewproduct = $viewproduct;
    }

    public function getCurrentProduct()
    {        
        return $this->viewproduct->getProduct();
    }

}



