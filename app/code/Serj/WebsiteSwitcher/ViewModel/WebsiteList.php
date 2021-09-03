<?php

namespace Serj\WebsiteSwitcher\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Serj\WebsiteSwitcher\Model\WebsiteTreeBuilder;

class WebsiteList implements ArgumentInterface
{
    /**
     * @var WebsiteTreeBuilder
     */
    private WebsiteTreeBuilder $websiteTreeBuilder;

    /**
     * @param WebsiteTreeBuilder $websiteTreeBuilder
     */
    public function __construct(
        WebsiteTreeBuilder $websiteTreeBuilder
    ) {
        $this->websiteTreeBuilder = $websiteTreeBuilder;
    }

    /**
     * @return array
     */
    public function getStores(): array
    {
        return $this->websiteTreeBuilder->build();
    }

    /**
     * @param array $websites
     */
    public function sortWebsites(array $websites): void
    {
        usort($websites, function ($a, $b) {
            return $a->getWebsiteId() > $b->getWebsiteId() ? 1: -1;
        });
    }
}
