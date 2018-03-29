<?php
/**
 * Created by PhpStorm.
 * User: magentodev
 * Date: 29/03/2018
 * Time: 17:24
 */

namespace Yarmolich\Todo\Controller\Adminhtml\Todo;


use Magento\Backend\App\Action;

/**
 * Class Save
 * @package Yarmolich\Todo\Controller\Adminhtml\Todo
 */
class Save extends Action
{
    /**
     * @var \Yarmolich\Todo\Model\Todo
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
        return $this->_authorization->isAllowed('return $this->_authorization->isAllowed(\'Yarmolich_Todo::todo\');');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Yarmolich\Todo\Model\Todo $model */
            $model = $this->_model->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'todo_prepare_save',
                ['todo' => $model, 'request' => $this->getRequest()]
            );

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Todo saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the todo'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}