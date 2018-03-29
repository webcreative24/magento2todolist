<?php

namespace Yarmolich\Todo\Model\ResourceModel\Todo;

/**
 * Class Collection
 * @package Yarmolich\Todo\Model\ResourceModel\Todo
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'todo_id';

    protected $_eventPrefix = 'yarmolich_todo_collection';

    protected $_eventObject = 'todo_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Yarmolich\Todo\Model\Todo', 'Yarmolich\Todo\Model\ResourceModel\Todo');
    }
}