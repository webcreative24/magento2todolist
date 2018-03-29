<?php

namespace Yarmolich\Todo\Block\Adminhtml\Todo;

use Magento\Backend\Block\Widget\Form\Container;

/**
 * Class Edit
 * @package Yarmolich\Todo\Block\Adminhtml\Todo
 */
class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Todo edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'todo_id';
        $this->_blockGroup = 'Yarmolich_Todo';
        $this->_controller = 'adminhtml_todo';

        parent::_construct();

        if ($this->_isAllowedAction('Yarmolich_Todo::todo')) {
            $this->buttonList->update('save', 'label', __('Save Todo'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

    }

    /**
     * Get header with Todo name
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('todo_department')->getId()) {
            return __("Edit Todo '%1'", $this->escapeHtml($this->_coreRegistry->registry('todo_department')->getName()));
        } else {
            return __('New Todo');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction()
    {
        return $this->_authorization->isAllowed('Yarmolich_Todo::todo');
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('todo/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}