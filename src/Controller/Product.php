<?php

namespace APP\Controller;

use APP\Model\DAO\ProductDAO;
use APP\Model\Product;
use APP\Model\Provider;
use APP\Utils\Redirect;
use APP\Model\Validation;
use Error;
use PDOException;

require '../../vendor/autoload.php';
if (!isset($_GET['operation'])) {
    Redirect::redirect('nenhuma operação foi enviada', type: 'error');
}
switch ($_GET['operation']) {
    case 'insert':
        insertProduct();
        break;
    case 'list':
        listProducts();
        break;
    case 'remove':
        removeProduct();
        break;
    case 'find':
        findProduct();
        break;
    case 'edit':
        editProduct();
        break;
    default:
        Redirect::redirect('A operação informada é invalida', type: 'error');
}

function removeProduct()
{
    if (empty($_GET['code'])) {
        Redirect::redirect(message: 'o Codigo do produto não foi informado', type: 'error');
    }
    $code = (float) $_GET['code'];
    $error = array();
    if (!Validation::validateNumber($code)) {
        array_push($error, 'Código do produto inválido!!!');
    }
    if ($error) {
        Redirect::redirect($error, type: 'warning');
    } else {
        try {
            $dao = new ProductDAO();
            $result = $dao->delete($code);
            if ($result) {
                Redirect::redirect(message: 'Produto removido com sucesso!!!');
            } else {
                Redirect::redirect(message: ['Não foi possivel remover o produto'], type: 'warning');
            }
        } catch (PDOException $e) {
            Redirect::redirect("Lamento,Houve um erro inesperado:", type: 'error');
        }
    }
}

function insertProduct()
{
    if (empty($_POST)) {
        session_start();
        // Redirecionar o usuário
        Redirect::redirect(
            type: 'error',
            message: 'Requisição inválida!!!'
        );
    }


    $productName = $_POST["name"];
    $productCostPrice = str_replace(",", ".", $_POST["cost"]);
    $quantity = $_POST["quantity"];
    $provider = $_POST["provider"];

    $error = array();

    // array_unshift -> Adicionar no início do array
    // array_push -> Adicionar no final do array

    // array_shift -> Remove do início do array
    // array_pop -> Remove do final do array

    if (!Validation::validateName($productName)) {
        array_push($error, "O nome do produto deve conter mais de 2 caracteres!!!");
    }

    if (!Validation::validateNumber($productCostPrice)) {
        array_push($error, "O preço de custo do produto deverá ser maior que zero!!!");
    }

    if (!Validation::validateNumber($quantity)) {
        array_push($error, "A quantidade de entrada deverá ser maior que zero!!!");
    }

    if ($error) {
        Redirect::redirect(
            message: $error,
            type: 'warning'
        );
    } else {
        $product = new Product(tax: 0.2, operationCost: 0.07, lucre: 0.8, cost: $productCostPrice, name: $productName, quantity: $quantity, provider: new Provider(cnpj: '0000/0001', name: "Fornecedor padrão"), id: $id = 0);
        try {
            $dao = new ProductDAO();
            $result = $dao->insert($product);
            if ($result) {
                Redirect::redirect(
                    message: "O produto $productName foi cadastrado com sucesso!!!"
                );
            } else {
                Redirect::redirect("Lamento, não foi possivel cadastrar o produto $productName", type: 'error');
            }
        } catch (PDOException $e) {
            // Redirect::redirect("Houve um erro inesperado:". $e->getMessage(), type:'error');
            Redirect::redirect("Lamento,Houve um erro inesperado:", type: 'error');
        }
    }
}

function listProducts()
{
    try {
        session_start();
        $dao = new ProductDAO();
        $products = $dao->findAll();
        if ($products) {
            $_SESSION['list_of_products'] = $products;
            header('location:../View/list_Of_Products.php');
        } else {
            Redirect::redirect(message: ['Não existem produtos cadastrados!!!'], type: 'warning');
        }
    } catch (PDOException $e) {
        Redirect::redirect("Lamento,Houve um erro inesperado!!!!", type: 'error');
    }
}

function  findProduct()
{
    if (empty($_GET['code'])) {
        Redirect::redirect(message: 'o codigo do produto não foi informado!!!!');
    }
    $code = $_GET['code'];
    $dao = new ProductDAO();
    try {
        $result = $dao->findOne($code);
    } catch (PDOException $e) {
        Redirect::redirect("Lamento,Houve um erro inesperado!!!!", type: 'error');
    }


    if ($result) {
        session_start();
        $_SESSION['product_info'] = $result;
        header("location:../View/form_edit_product.php");
    } else {
        Redirect::redirect(message: 'Lamento não localizamos o produto em nossa base de dados', type: 'error');
    }
}

function editProduct()
{
    if (empty($_POST)) {
        Redirect::redirect(message: 'Requisição inválida !!!', type: 'error');
    }

    $code = $_POST['code'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];

    $error = array();
    if (!Validation::validateName($name)) {
        array_push($error, 'o nome do produto deve conter ao menos 3 caracteres!!!');
    }
    if (!Validation::validateNumber($quantity)) {
        array_push($error, 'A quantidade em estoque deve ser superior a zero!!!');
    }

    $product = new Product(
        cost:0,
        tax:0,
        operationCost:0,
        lucre:0,
        quantity:$quantity,
        name:$name,
        provider:new Provider(
            cnpj:'00000/0001',
            name: "fornecedor padrão"
        ),
        id:$code
        );
        $dao = new ProductDAO();
        $result = $dao->update($product);
        if($result){
            Redirect::redirect(message:'Produto atualizado com sucesso!!!');
        }else{
            Redirect::redirect(message:['Não foi possivel atualizar os dados do produto!!!']);
        }
}
