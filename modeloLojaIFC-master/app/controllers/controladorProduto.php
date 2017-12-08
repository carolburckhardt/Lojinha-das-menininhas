<?php
// O Controlador é a peça de código que sabe qual classe chamar, para onde redirecionar e etc.
// Use o método $_GET para obter informações vindas de outras páginas.


require_once "../models/Produto.php";
require_once "../models/CrudProdutos.php";


if ($_GET['acao']== 'cadastrar'){


    $produto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['estoque']);
    $crud = new CrudProdutos();
    $crud->salvar($produto);
header('location: ../views/admin/produtos.php');
}


if ($_GET['acao'] == 'editar'){
    $nome       = $_POST['nome'];
    $preco      = $_POST['preco'];
    $categoria  = $_POST['categoria'];
    $estoque    = $_POST['estoque'];
    $codigo     = $_POST['codigo'];

    $crud = new CrudProdutos();
    $crud->editar($codigo, $nome, $categoria, $preco, $estoque);

    header('location:../views/admin/produtos.php');

}


if ($_GET['acao']== 'excluir'){


    $crud = new CrudProdutos();
    $crud -> excluirProdutos($_GET['codigo']);

    header('location:../views/admin/produtos.php?msg= Excluido com super sucesso');

}

if ($_GET['action'] == 'comprar'){

    $crud = new CrudProdutos();
    $msg = $crud->comprar($_POST['codigo'], $_POST['estoque']);
    header("location: ../views/produto.php?codigo=$_POST[codigo]&msg=$msg");
}

