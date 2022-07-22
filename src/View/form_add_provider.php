<?php require_once'../Controller/auth.php'; ?>
<!DOCTYPE html>
<html lang="Pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de varejo - cadastro provedor</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class='bg-blue-400'>
        <ul >
            <li class="inline">
                <a href="dashboard.php">Home</a>
        </li>
        <li class="inline ">
                    <a href="form_add_product.php">Novo produto</a>
            </li>
            <li class="inline">
                <a href="#">Novo Fornecedor</a>

            </li>
            <li class="inline">
                <a href="../../src/controller/Product.php?operation=list">Listar Produtos</a>
            </li>
            <li class="inline">
          <a href="list_of_providers.php">Listar Fornecedores</a>
        </li>
            
        </ul>
    </nav>
    <form action="../Controller/Provider.php?operation=list" method="POST">
        <fieldset class="p-4 m-5 border border-blue-400">
            <legend>Dados do Fornecedor</legend>
            <section class="columns-2">
                <article>
                    <label for="name">Nome do fornecedor</label>
                    <input type="text" id="name" name="name" class="border border-blue-400" required minlength="5">
                </article>
                <article>
                    <label for="cnpj">CNPJ do fornecedor</label>
                    <input type="text" id="cnpj" name="cnpj" class="border border-blue-400" required minlength="14">
                </article>
            </section>
            <section class="mt-4 columns-2">
                <article>
                    <label for="phone">Telefone do fornecedor</label>
                    <input type="text" id="phone" name="phone" class="border border-blue-400">
                </article>
            </section>
        </fieldset>
        <fieldset class="p-4 m-5 border border-blue-400">
            <legend>Endereço do fornecedor</legend>
            <section class="columns-4">
                <article>
                    <label for="publicPlace">Logradouro</label>
                    <input type="text" id="publicPlace" name="publicPlace" class="border border-blue-400 ">
                </article>
                <article>
                    <label for="numberOfStreet">Número</label>
                    <input type="number" id="numberOfStreet" name="numberOfStreet" class="border border-blue-400">
                </article>
                <article>
                    <label for="streetName">Nome da rua </label>
                    <input type="text" id="streetName" name="streetName" class="border border-blue-400">
                </article>
                <article>
                    <label for="complement">Complemento</label>
                    <input type="text" id="complement" name="complement" class="border border-blue-400 ">
                </article>
            </section>
            <section class="mt-4 columns-3">
                <article>
                    <label for="neighborhood">Bairro</label>
                    <input type="text" id="neighborhood" name="neighborhood" class="border border-blue-400 ">
                </article>
                <article>
                    <label for="city">Cidade</label>
                    <input type="text" id="city" name="city" class="border border-blue-400 ">
                </article>
                <article>
                    <label for="zipCode">Cep</label>
                    <input type="text" id="zipCode" name="zipCode" class="border border-blue-400 ">
                </article>
            </section>

        </fieldset>
        <article class="flex justify-center mt-4">
            <button type="submit" class="p-4 text-white bg-blue-700 rounded">Cadastrar</button>
        </article>
    </form>
</body>

</html>