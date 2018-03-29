<?php

namespace Yarmolich\Todo\Block\Adminhtml\Todo\Edit;


use \Magento\Backend\Block\Widget\Form\Generic;

/**
 * Class Form
 * @package Yarmolich\Todo\Block\Adminhtml\Todo\Edit
 */
class Form extends Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Yarmolich\Todo\Model\Config\Status
     */
    protected $_source;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Yarmolich\Todo\Model\Config\Status $sourse,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_source  = $sourse;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('todo_form');
        $this->setTitle(__('Todot Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Yarmolich\Todo\Model\Todo $model */
        $model = $this->_coreRegistry->registry('todo_department');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('todo_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Edit Todo'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('todo_id', 'hidden', ['name' => 'todo_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Todo Name'),
                'title' => __('Todo Name'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'description',
            'textarea',
            [
                'name' => 'description',
                'label' => __('Todo Description'),
                'title' => __('Todo Description'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'start_time',
            'date',
            [
                'name' => 'start_time', 'label' => __('Start Time'),
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss',
                'title' => __('Start Time'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'end_time',
            'date',
            [
                'name' => 'end_time', 'label' => __('End Time'),
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss',
                'title' => __('End Time'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'to_person',
            'text',
            [
                'name' => 'to_person',
                'label' => __('Assigned Person'),
                'title' => __('Assigned Person'),
                'required' => false
            ]
        );

        $fieldset->addField('status', 'select', [
            'label' => __('Status'),
            'title' => __('Status'),
            'name' => 'status',
            'required' => true,
            'values' => $this->_source->toOptionArray()
        ]);

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}