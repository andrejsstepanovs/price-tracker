<?php

namespace PriceTracker;

use PriceTracker\Data\Product;
use PriceTracker\Data\Store;
use Goutte\Client as Http;

/**
 * Class Client
 *
 * @package PriceTracker
 */
class Client
{
    /**
     * @param Store $store
     *
     * @return int
     */
    public function fetchStorePrice(Store $store)
    {
        $client = new Http;

        /** @var \Symfony\Component\DomCrawler\Crawler $crawler */
        $crawler = $client->request('GET', $store->getUrl());

        /** @var \Symfony\Component\BrowserKit\Response $response */
        $response = $client->getResponse();
        if ($response->getStatus() != 200) {
            throw new \RuntimeException('Request failed "' . $store->getUrl() . '" (' . $response->getStatus() . ')');
        }

        $element = $crawler->filter($store->getSelector());

        $selectorValue = $store->getSelectorValue();
        switch ($selectorValue) {
            case 'innerHTML':
                $value = $element->html();
                break;
            default:
                $value = $element->attr($selectorValue);
                break;
        }

        return $this->getPriceValue($value);
    }

    /**
     * @param string $value
     *
     * @return float
     */
    private function getPriceValue($value)
    {
        $value = str_replace(',', '.', $value);

        preg_match('/\d+.\d+/', $value, $matches);
        if (!$matches || empty($matches[0])) {
            throw new \RuntimeException('Failed to get price from "' . $value . '"');
        }

        return floatval($matches[0]);
    }
}
