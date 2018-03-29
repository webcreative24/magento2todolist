<?php

namespace Yarmolich\Todo\Model\ResourceModel;

/**
 * Class Todo
 * @package Yarmolich\Todo\Model\ResourceModel
 */
class Todo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Todo constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('yarmolich_todo', 'todo_id');
    }
}