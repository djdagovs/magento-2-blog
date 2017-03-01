<?php
/**
 * Mageplaza_Blog extension
 *                     NOTICE OF LICENSE
 * 
 *                     This source file is subject to the MIT License
 *                     that is bundled with this package in the file LICENSE.txt.
 *                     It is also available through the world-wide-web at this URL:
 *                     http://opensource.org/licenses/mit-license.php
 * 
 *                     @category  Mageplaza
 *                     @package   Mageplaza_Blog
 *                     @copyright Copyright (c) 2016
 *                     @license   http://opensource.org/licenses/mit-license.php MIT License
 */
namespace Mageplaza\Blog\Controller\Adminhtml\Category;

class RefreshPath extends \Mageplaza\Blog\Controller\Adminhtml\Category
{
    /**
     * JSON Result Factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * constructor
     * 
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Mageplaza\Blog\Model\CategoryFactory $categoryFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Mageplaza\Blog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($categoryFactory, $coreRegistry, $context);
    }


    /**
     * Build response for refresh input element 'path' in form
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $categoryId = (int)$this->getRequest()->getParam('category_id');
        if ($categoryId) {
            $category = $this->categoryFactory->create()->load($categoryId);

            /** @var \Magento\Framework\Controller\Result\Json $resultJson */
            $resultJson = $this->resultJsonFactory->create();
            return $resultJson->setData(['id' => $categoryId, 'path' => $category->getPath()]);
        }
    }
}
