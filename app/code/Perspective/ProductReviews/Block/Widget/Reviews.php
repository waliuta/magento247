<?php
namespace Perspective\ProductReviews\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory;

class Reviews extends Template implements \Magento\Widget\Block\BlockInterface
{
    protected $_reviewCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $reviewCollectionFactory,
        array $data = []
    ) {
        $this->_reviewCollectionFactory = $reviewCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getReviews()
    {
        $product = $this->getLayout()->getBlock('product.info')->getProduct();
        $collection = $this->_reviewCollectionFactory->create()
            ->addEntityFilter('product', $product->getId())
            ->setDateOrder();

        return $collection;
    }
}
