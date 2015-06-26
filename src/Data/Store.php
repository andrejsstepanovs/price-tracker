<?php

namespace PriceTracker\Data;

/**
 * Class Store
 *
 * @package PriceTracker
 */
class Store
{
    /** @var string */
    private $name;

    /** @var string */
    private $url;

    /** @var string */
    private $selector;

    /** @var string */
    private $selectorValue;

    /** @var Product */
    private $product;

    /** @var float */
    private $price;

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $selector
     *
     * @return $this
     */
    public function setSelector($selector)
    {
        $this->selector = $selector;

        return $this;
    }

    /**
     * @param string $selectorValue
     *
     * @return $this
     */
    public function setSelectorValue($selectorValue)
    {
        $this->selectorValue = $selectorValue;

        return $this;
    }

    /**
     * @param Product $product
     *
     * @return $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        if (!is_float($price)) {
            throw new \RuntimeException('Price is not "float"');
        }

        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * @return string
     */
    public function getSelectorValue()
    {
        return $this->selectorValue;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function formatPrice()
    {
        return money_format('%i', $this->getPrice());
    }
}