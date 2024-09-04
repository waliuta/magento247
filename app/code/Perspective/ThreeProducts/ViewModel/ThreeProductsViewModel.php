<?php
namespace Perspective\ThreeProducts\ViewModel;

class ThreeProductsViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Block\Product\View
     */
    private $viewproduct;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $productCollectionFactory;

    public function __construct(

        \Magento\Catalog\Block\Product\View $viewproduct,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {

        $this->viewproduct = $viewproduct;
        $this->productCollectionFactory = $productCollectionFactory;
    }

    public function getCurrentProduct()
    {        
        return $this->viewproduct->getProduct();
    }

    public function getCurrentCategoryIds()
    {        
        return  $this->getCurrentProduct()->getCategoryIds();
    }
    

    public function getCurrentFirstCategoryId()
    {        
        $categoryIds =  $this->getCurrentProduct()->getCategoryIds();
         if (!empty($categoryIds)) {
            // Берем первый ID из массива категорий
            $firstCategoryId = $categoryIds[0];
        return $firstCategoryId;
    }
    }

    public function getProductsByCategoryId($currentProduct, $categoryId, $rate, $countProducts)
    {
        // Загружаем коллекцию продуктов по ID категории
        $productCollection = $this->productCollectionFactory->create()
            ->addAttributeToSelect('*') // Выбираем все атрибуты продуктов
            ->addCategoriesFilter(['in' => $categoryId]) // Фильтр по ID категории
            ->addFieldToFilter('price', ['from' => $currentProduct->getFinalPrice() - $rate, 'to' => $currentProduct->getFinalPrice() + $rate])
            ->setPageSize($countProducts) // Ограничиваем коллекцию 3 продуктами
            ->load();

        return $productCollection;
    }

}



