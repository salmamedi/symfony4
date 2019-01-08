<?php

namespace App\Entity;



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
     * @return int|null
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;
    }

    /**
     * @return int|null
     */
    public function getMinRoom()
    {
        return $this->minRoom;
    }

    /**
     * @param int|null $minRoom
     */
    public function setMinRoom($minRoom)
    {
        $this->minRoom = $minRoom;
    }


}
