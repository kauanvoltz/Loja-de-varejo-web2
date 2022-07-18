<?php

namespace APP\Model;

class Address
{
    private int $id;
    private string $publicPlace;
    private string $streetName;
    private string $numberOfStreet;
    private string $complement;
    private string $neighborhood;
    private string $city;
    private string $zipCode;

    public function __construct(int $id=0 ,string $publicPlace,string $numberOfStreet,string $complement,string $neighborhood,string $city,string $zipCode, string $streetName)
    {
        $this->id = $id;
        $this->publicPlace = $publicPlace;
        $this->streatName = $streetName;
        $this->numberOfStreet = $numberOfStreet;
        $this->complement = $complement;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->zipcode = $zipCode;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }
    public function __set($attribute, $value)
    {
        $this->$attribute = $value;

    }
}
