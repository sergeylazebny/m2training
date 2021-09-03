<?php

namespace Serj\WebsiteSwitcher\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Mode implements OptionSourceInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 'auto', 'label' => __('Auto')],
            ['value' => 'custom', 'label' => __('Custom')]
        ];
    }
}
