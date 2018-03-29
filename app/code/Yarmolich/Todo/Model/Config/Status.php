<?php

namespace Yarmolich\Todo\Model\Config;

use Magento\Framework\Option\ArrayInterface;

/**
 * Return humans statuses
 *
 * Class Status
 * @package Yarmolich\Todo\Model\Config
 */
class Status implements ArrayInterface
{
    public $arrStatuses = array(
        1 => "TODO",
        2 => "In Progress",
        3 => "Done",
    );

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $optionsArray = [];
        foreach ($this->arrStatuses as $key => $value) {
            $optionsArray[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        return $optionsArray;
    }
}