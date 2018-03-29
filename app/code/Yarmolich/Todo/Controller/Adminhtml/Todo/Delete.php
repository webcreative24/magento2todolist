<?php

namespace Yarmolich\Todo\Controller\Adminhtml\Todo;

use Magento\Backend\App\Action;

/**
 * Class Delete
 * @package Yarmolich\Todo\Controller\Adminhtml\Todo
 */
class Delete extends Action
{
    /**
     * @var \Yarmolich\Todo\Model\TodoFactory
     */
    protected $_model;

    /**
     * @param Action\Context $context
     * @param \Yarmolich\Todo\Model\TodoFactory $model
     */
    public function __construct(
        Action\Context $context,
        \Yarmolich\Todo\Model\TodoFactory $model
    )
    {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Yarmolich_Todo::todo');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Todo deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Todo does not exist'));

        return $resultRedirect->setPath('*/*/');
    }
}