<?php

namespace Yarmolich\Todo\Ui\Component\Listing\Column;

class Status extends \Magento\Ui\Component\Listing\Columns\Column
{
    public $statuses = null;

    /**
     * Status constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Yarmolich\Todo\Model\Config\Status $statuses
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Yarmolich\Todo\Model\Config\Status $statuses,
        array $components = [],
        array $data = []
    )
    {
        $this->statuses = $statuses;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $this->statuses->toOptionArray();

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['status'] = $this->statuses->arrStatuses[$item['status']];
            }
        }

        return $dataSource;
    }
}