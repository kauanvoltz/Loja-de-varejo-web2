<?php
namespace APP\Controller;

use APP\Model\Provider;
use APP\Model\Address;
use APP\Utils\Redirect;
use APP\Model\Validation;

require '../../vendor/autoload.php';

if(empty($_POST)){
    session_start();
    Redirect::redirect(
        type:'error',
        message:'Requisição inválida!!!'
    );
}

$providerName = $_POST['name'];
$providerCnpj = $_POST['cnpj'];
$providerPhone = $_POST["phone"];
$providerPublicPlace = $_POST['publicPlace'];
$providerNumberOfStreet = $_POST['numberOfStreet'];
$providerComplement = $_POST['complement'];
$providerNeighborhood = $_POST['neighborhood'];
$providerCity= $_POST['city'];
$providerZipCode = $_POST['zipCode']; 
$providerAdress = $_POST['$address'];

$error = array();
if(!Validation::validateName($providerName)){
    array_push($error, "O nome deve conter mais de 2 caracteres!!!");
}
if(!Validation::validateCnpj($providerCnpj)){
    array_push($error, "O cnpj deve  conter 14 digitos");
}
if(!empty($providerPhone)){
    if(!Validation::validatePhone($providerPhone)){
        array_push($error, "Número de telefone invalido");
    }
}
if(!empty($providerPublicPlace)){
    if(!Validation::validatePublicPlace($providerPublicPlace)){
        array_push($error, "O logradouro deve haver 3 ou mais caracteres");
    }
}
if(!empty($providerNumberOfStreet)){
    if(!Validation::validateNumberOfStreet($providerNumberOfStreet)){
        array_push($error,"o número da residência deve ser maior que 0");
    }
}
if(!empty($providerComplement)){
    if(!Validation::validateComplement($providerComplement)){
        array_push($error,"o número de caracteres do complemento deve ser maior que ");
    }
}
if(!empty($providerNeighborhood)){
    if(!Validation::validateNeighborhood($providerNeighborhood)){
        array_push($error,"o número de caracteres do bairro deve ser maior que 3");
    }
}
if(!empty($providerCity)){
    if(!Validation::validateCity($providerCity)){
        array_push($error,"o número de caracteres da cidade deve ser maior que 3");
    }
}
if(!empty($providerZipCode)){
    if(!Validation::validateZipcode($providerZipCode)){
        array_push($error,"o número de caracteres do cep deve ser maior que 4");
    }
}
if($error){
    Redirect::redirect(
        message:$error,
        type:'warning'
    );
}else{
        $provider = new Provider( name: $providerName, cnpj: $providerCnpj , phone: $phone , address: $adress);

        Redirect::redirect(
            message:"O fornecedor $providername foi cadastrado com sucesso!!!!!!"
        );
    }
    //teste


