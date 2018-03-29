<?php

namespace Yarmolich\Todo\Model;

/**
 * Class Todo
 * @package Yarmolich\Todo\Model
 */
class Todo extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'yarmolich_todo';

    protected $_cacheTag = 'yarmolich_todo';

    protected function _construct()
    {
        $this->_init('Yarmolich\Todo\Model\ResourceModel\Todo');
    }

    protected $_eventPrefix = 'yarmolich_todo';

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

}