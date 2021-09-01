<?php

namespace Serj\WebsiteSwitcher\Model;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class WebsiteTreeBuilder
{
    private $storeManager;

    private $urlBuilder;

    public function __construct(StoreManagerInterface $storeManager, UrlInterface $urlBuilder)
    {
        $this->storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;
    }

    public function build(): array
    {
        $websites = $this->storeManager->getWebsites();
        $stores = $this->storeManager->getStores();

        $storeTree = [];
        foreach ($stores as $store) {
            $storeTree[$store->getWebsiteId()][] = [
                'name' => $store->getName(),
                'link' => $store->getBaseUrl()
            ];
        }

        $websiteTree = [];
        foreach ($websites as $website) {
            $websiteTree[$website->getName()] = $storeTree[$website->getId()] ?? [];
        }

        ksort($websiteTree);

        return $websiteTree;
    }
}
