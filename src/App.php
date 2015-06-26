<?php

namespace PriceTracker;

use PriceTracker\Data\Product;
use PriceTracker\Data\Store;


/**
 * Class App
 *
 * @package PriceTracker
 */
class App
{
    /** @var array */
    private $config;

    /** @var Product[] */
    private $products = [];

    /** @var Client */
    private $client;

    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Client
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * @param array $config
     *
     * @return $this
     */
    public function setConfig(array $config)
    {
        $this->config = $config;

        return $this;
    }

    public function init()
    {
        setlocale(LC_MONETARY, $this->config['locale']);

        foreach ($this->config['product'] as $productData) {
            $product = new Product;
            $product->setName($productData['name']);
            $product->setPictureUrl($productData['picture']);

            foreach ($productData['store'] as $storeData) {
                $store = new Store;
                $store->setName($storeData['name']);
                $store->setUrl($storeData['url']);

                $selectorData = $storeData['selector'];

                $store->setSelector($selectorData['path']);
                $store->setSelectorValue($selectorData['value']);
                $store->setProduct($product);

                $product->addStore($store);
            }

            $this->addProduct($product);
        }
    }

    /**
     * @param Product $product
     *
     * @return $this
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * @return $this
     */
    public function fetch()
    {
        foreach ($this->products as $product) {
            foreach ($product->getStores() as $store) {
                try {
                    $price = $this->getClient()->fetchStorePrice($store);
                    $store->setPrice($price);
                } catch (\InvalidArgumentException $exc) {

                } catch (\RuntimeException $exc) {

                }
            }
        }

        return $this;
    }

    public function output()
    {
        foreach ($this->products as $product) {
            echo $product->getName() . PHP_EOL;
            foreach ($product->getStores() as $store) {
                echo $store->getName() . ' ' . $store->formatPrice() . PHP_EOL;
            }
            echo PHP_EOL;
        }
    }
}