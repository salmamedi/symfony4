<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;




class Search
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minRoom;

    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMinRoom()
    {
        return $this->minRoom;
    }

    /**
     * @param int $minRoom
     * @return Search
     */
    public function setMinRoom(int $minRoom): Search
    {
        $this->minRoom = $minRoom;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;

    }

    /**
     * @param int $maxPrice
     * @return Search
     */
    public function setMaxPrice(int $maxPrice): Search
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }


}
