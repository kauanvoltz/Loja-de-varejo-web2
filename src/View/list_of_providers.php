<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Listagem de fornecedores</title>
</head>

<body>
    <nav class='bg-blue-400'>
        <ul>
            <li class="inline">
                <a href="../../index.html">Home</a>
            </li>
            <li class="inline ">
                <a href="form_add_product.php">Novo produto</a>
            </li>
            <li class="inline">
                <a href="form_add_provider.php">Novo Fornecedor</a>

            </li>
            <li class="inline">
                <a href="list_of_products.php">Listar Produtos</a>
            </li>
            <li class="inline">
                <a href="#">Listar Fornecedores</a>
            </li>

        </ul>
    </nav>
    <h1 class="my-4 text-3xl font-bold text-center text-blue-600">Lista de fornecedores cadastrados</h1>
    <table class="m-auto">
        <thead class="text-white bg-blue-400">
            <th>CNPJ</th>
            <th>Nome do fornecedor</th>
            <th>Contato do fornecedor</th>
            <th>Id do endereço</th>
        </thead>
        <tbody>
            <?php

            use APP\Model\Address;

            session_start();
            foreach ($_SESSION['list_of_providers'] as $provider) :
            ?>
                <tr>
                    <td>
                        <?= $provider['cnpj'] ?>
                    </td>
                    <td>
                        <?= $provider['provider_name'] ?>
                    </td>
                    <td>
                        <?= $provider['phone'] ?>
                    </td>
                    <td>
                        <?= $provider['address_code'] ?>
                    </td>
                </tr>

            <?php
            endforeach;
            ?>
               
            
        </tbody>
    </table>
</body>

</html>