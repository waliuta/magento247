<?php
namespace Yuriy\TutorialEntity\ViewModel;
use Magento\Catalog\Api\Data\ProductInterface;

class TutorialViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
  * @var \Magento\Catalog\Api\ProductRepositoryInterface
  */
  private $_productRepository;
  /**
   * @var \Magento\Framework\Api\SearchCriteriaBuilder
   */
  private $_searchCriteriaBuilder;
  /**
   * @param \Magento\Framework\View\Element\Template\Context $context
   * @param array $data
   */
  public function __construct(
      \Magento\Framework\View\Element\Template\Context $context,
      \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
      \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
      array $data = []
  ) {
      $this->_productRepository = $productRepository;
      $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
    
  }
  public function getProductById($productId)
  {
      if (is_null($productId)){
          return null;
      }
      $productModel = $this->_productRepository->getById($productId);
      return $productModel;
  }
  public function getCheapProducts($price){
      if (is_null($price)){
          return null;
      }
      $this->_searchCriteriaBuilder->addFilter(
          ProductInterface::PRICE,
          $price,
          'lt');
      $searchCriteria = $this->_searchCriteriaBuilder->create();
      $productCollection = $this->_productRepository->getList($searchCriteria);
      return $productCollection->getItems();
  }
}