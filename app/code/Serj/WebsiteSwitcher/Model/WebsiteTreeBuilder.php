<?php

namespace Serj\WebsiteSwitcher\Model;

use Magento\Store\Model\StoreManagerInterface;

class WebsiteTreeBuilder
{
    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
    }

    /**
     * @return array
     */
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
