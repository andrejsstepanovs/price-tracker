<?php

namespace PriceTracker\Data;

/**
 * Class Product
 *
 * @package PriceTracker
 */
class Product
{
    /** @var string */
    private $name;

    /** @var string */
    private $pictureUrl;

    /** @var Store[] */
    private $stores = [];

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
     * @param string $pictureUrl
     *
     * @return $this
     */
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * @param Store $store
     *
     * @return $this
     */
    public function addStore(Store $store)
    {
        $this->stores[] = $store;

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
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }

    /**
     * @return Store[]
     */
    public function getStores()
    {
        return $this->stores;
    }
}