<?php

namespace Serj\WebsiteSwitcher\ViewModel;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Api\WebsiteRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Serj\WebsiteSwitcher\Model\WebsiteTreeBuilder;

class Switcher implements ArgumentInterface
{
    private $websiteTreeBuilder;

    public function __construct(
        WebsiteTreeBuilder $websiteTreeBuilder
    ) {
        $this->websiteTreeBuilder = $websiteTreeBuilder;
    }

    public function getStores(): array
    {
        return $this->websiteTreeBuilder->build();
    }

    public function sortWebsites(array $websites): void
    {
        usort($websites, function ($a, $b) {
            return $a->getWebsiteId() > $b->getWebsiteId() ? 1: -1;
        });
    }
}
