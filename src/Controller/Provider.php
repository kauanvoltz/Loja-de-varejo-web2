<?php

namespace APP\Controller;

use APP\Model\Provider;
use APP\Model\Address;
use APP\Model\DAO\AddressDAO;
use APP\Model\DAO\ProviderDAO;
use APP\Utils\Redirect;
use APP\Model\Validation;
use PDOException;

require '../../vendor/autoload.php';

if (empty($_POST)) {
    session_start();
    Redirect::redirect(
        type: 'error',
        message: 'Requisição inválida!!!'
    );
}

$providerCnpj = $_POST['cnpj'];
$providerName = $_POST['name'];
$providerPhone = $_POST["phone"];
$providerPublicPlace = $_POST['publicPlace'];
$providerStreetName = $_POST['streetName'];
$providerNumberOfStreet = $_POST['numberOfStreet'];
$providerComplement = $_POST['complement'];
$providerNeighborhood = $_POST['neighborhood'];
$providerCity = $_POST['city'];
$providerZipCode = $_POST['zipCode'];

$error = array();
if (!Validation::validateName($providerName)) {
    array_push($error, "O nome deve conter mais de 2 caracteres!!!");
}
if (!Validation::validateCnpj($providerCnpj)) {
    array_push($error, "O cnpj deve  conter 14 digitos");
}
if (!empty($providerPhone)) {
    if (!Validation::validatePhone($providerPhone)) {
        array_push($error, "Número de telefone invalido");
    }
}
if (!empty($providerPublicPlace)) {
    if (!Validation::validatePublicPlace($providerPublicPlace)) {
        array_push($error, "O logradouro deve haver 3 ou mais caracteres");
    }
}
if (!empty($providerNumberOfStreet)) {
    if (!Validation::validateNumberOfStreet($providerNumberOfStreet)) {
        array_push($error, "o número da residência deve ser maior que 0");
    }
}
if (!empty($providerComplement)) {
    if (!Validation::validateComplement($providerComplement)) {
        array_push($error, "o número de caracteres do complemento deve ser maior que ");
    }
}
if (!empty($providerNeighborhood)) {
    if (!Validation::validateNeighborhood($providerNeighborhood)) {
        array_push($error, "o número de caracteres do bairro deve ser maior que 3");
    }
}
if (!empty($providerCity)) {
    if (!Validation::validateCity($providerCity)) {
        array_push($error, "o número de caracteres da cidade deve ser maior que 3");
    }
}
if (!empty($providerZipCode)) {
    if (!Validation::validateZipcode($providerZipCode)) {
        array_push($error, "o número de caracteres do cep deve ser maior que 4");
    }
}
if ($error) {
    Redirect::redirect(
        message: $error,
        type: 'warning'
    );
} else {
    $provider = new Provider(name: $providerName, cnpj: $providerCnpj, phone: $providerPhone);
    $address = new Address(publicPlace: $providerPublicPlace, streetName: 'Rua A', numberOfStreet: $providerNumberOfStreet, complement: $providerComplement, neighborhood: $providerNeighborhood, city: $providerCity, zipCode: $providerZipCode);
    try {
        $dao = new AddressDAO();
        $result = $dao->insert($provider->address);
        if ($result) {
            $provider->address->id = $dao->findId();

            $dao = new ProviderDAO();
            $result = $dao->insert($provider);
            if ($result) {
                Redirect::redirect(
                    message: "O fornecedor $providername foi cadastrado com sucesso!!!!!!"
                );
            } else {
                Redirect::redirect("Lamento, não foi possivel cadastrar o fornecedor $providerName", type: 'error');
            }
        }
    } catch (PDOException $e) {
        Redirect::redirect("Lamento,Houve um erro inesperado:", type: 'error');
        // var_dump($e->getMessage());
        // Notificar o desenvolvedor
    }
}
