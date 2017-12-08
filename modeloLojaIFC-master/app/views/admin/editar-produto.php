

<?php

require_once "../../models/CrudProdutos.php";
$crud= new CrudProdutos();
$codigo = $_GET['codigo'];
$produto=$crud->getProduto($_GET['codigo']);
require_once "cabecalho.php";
?>

<h2>Editar Produtos</h2>
<form action="../../controllers/controladorProduto.php?acao=editar" method="post">
    <div class="form-group">
        <label for="produto">Produto:</label>
        <input value="<?= $produto->nome ?>" name="nome" type="text" class="form-control" id="produto" aria-describedby="nome produto" placeholder="">
    </div>

    <div class="form-group">
        <label for="preco">Preço</label>
        <input value="<?= $produto->preco ?>" name="preco" type="number" step="0.01" class="form-control" id="preco" placeholder="">
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input value="<?= $produto->estoque ?>" name="estoque" type="number" class="form-control" >
    </div>

    <div class="form-group">
        <label for="Categoria">Categoria</label>
        <select name="categoria" class="form-control" id="Categoria">
            <option <?php if($produto->categoria== "Pele") {echo "selected";} ?> >Pele</option>
            <option <?php if($produto->categoria== "Olhos") {echo "selected";} ?> >Olhos</option>
            <option <?php if($produto->categoria== "Boca") {echo "selected";} ?> >Boca</option>
        </select>
    </div>

    <input type="hidden" name="codigo" value="<?= $codigo ?>">

    <button type="submit" class="btn btn-success">Atualizar produto</button>

</form>

<?php require_once "rodape.php"; ?>
