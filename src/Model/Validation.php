<?php

namespace APP\Model;

class Validation
{
    public static function validateName(string $name): bool
    {
        return mb_strlen($name) > 2;
    }

    public static function validateNumber(float $number)
    {
        return $number > 0;
    }
    public static function validateCnpj(string $cnpj)
    {
        return mb_strlen ($cnpj) == 14;
    }
    public static function validatePhone(string $phone):bool
    {
        return preg_match("/^\(?\d{2}\)?[\s-]?\d{4}-?\d{4}$/",$phone);
    }
    public static function validatePublicPlace(string $publicPlace)
    {
        return mb_strlen($publicPlace) >= 3;
    }
    public static function validateNumberOfStreet(string $numberOfStreet):int
    {
        return mb_strlen($numberOfStreet) > 0;
    }
    public static function validateComplement(string $complement)
    {
        return mb_strlen($complement) > 3;
    }
    public static function validateNeighborhood(string $neighborhood)
    {
        return mb_strlen($neighborhood) > 3;
    }
    public static function validateCity(String $city)
    {
        return mb_strlen($city) > 3;
    }
    public static function validateZipcode(string $zipCode)
    {
        return mb_strlen($zipCode) > 4;
    }
}
