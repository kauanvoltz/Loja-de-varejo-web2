<?php require_once'../Controller/auth.php'; ?>
<?php

use APP\Model\Product;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de varejo - Cadastro de produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class='bg-blue-400'>
        <ul>
            <li class="inline">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="inline ">
                <a href="#">Novo produto</a>
            </li>
            <li class="inline">
                <a href="form_add_provider.php">Novo Fornecedor</a>

            </li>
            <li class="inline">
                <a href="../../src/controller/Product.php?operation=list">Listar Produtos</a>
            </li>
            <li class="inline">
          <a href="list_of_providers.php">Listar Fornecedores</a>
        </li>
        </ul>
    </nav>
    <?php 
        session_start();
        $product = $_SESSION['product_info'];
    ?>
    <form action="../controller/Product.php? operation=edit" method="POST">
        <input type="hidden" name="code" value="<?=  $product ['product_code']?>">
        <fieldset class="p-4 m-5 border border-blue-400">
            <legend>Dados do produto</legend>
            <section class="columns-2">
                <article>
                    <label for="name">Nome do produto</label>
                    <input type="text" id="name" name="name" class="border border-blue-400" required minlength="5" value="<?= $product ['product_name']?>">
                </article>
                <article>
                    <label for="cost">Preço de custo</label>
                    <input type="text" id="cost" name="cost" class="border border-blue-400" required min="1" max="1000" value="<?= $product ['price']?>">
                </article>
            </section>
            <section class="mt-4 columns-2">
                <article>
                    <label for="quantity">Quantidade em estoque</label>
                    <input type="number" id="quantity" name="quantity" class="border border-blue-400" required min="1" max="1000" value="<?= $product ['quantity']?>">
                </article>
                <article>
                    <label for="provider">Fornecedor</label>
                    <select name="provider" id="provider">
                        <option value="1">Fornecedor 1</option>
                        <option value="2">Fornecedor 2</option>
                        <option value="3">Fornecedor 4</option>
                    </select>
                </article>
            </section>
            <article class="flex justify-center mt-4">
                <button type="submit" class="p-4 text-white bg-blue-700 rounded">Alterar</button>
            </article>
        </fieldset>
    </form>
</body>

</html>