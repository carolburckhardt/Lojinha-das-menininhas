<?php
//
    require_once "../models/CrudProdutos.php";


    $crud = new CrudProdutos();

//    //seguranca
    $codigo = filter_input(INPUT_GET, 'codigo', FILTER_VALIDATE_INT); //consulte os slides.
//
    $produto = $crud->getProduto($codigo);
    if(isset($_POST['comprar'])){
        echo("<script>alert('".$crud->Comprar($codigo, intval($_POST['quantidade']))."');window.location=window.location;</script>");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lojão do IFC</title>

    <!-- Bootstrap core CSS -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/ifc-style.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="../../assets/imagens/logo.png" alt="" width="80px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../../index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container product-content">

    <!-- Page Features -->
    <div class="row">

        <div class="col-md-5">
            <img src="../../assets/imagens/" alt="" class="img-fluid">
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <h2><?= $produto->nome; ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    Categoria: <?= $produto->categoria ?> <br> Disponibilidade: <?= $produto-> estoque ?>
                    <hr>
                </div>
            </div>
            <!-- end row -->

            <div class="row description-wrapper">
                <div class="col-md-12">
                    <p class="description">
                    </p>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-12 bottom-rule">
                    <h2 class="product-price">Mostre o preço</h2>
                </div>
            </div>
            <!-- end row -->
            <div class="container" style="margin-bottom: 50px;">
                <div class="row">
                    <form method="POST">
                        <div class="col-xs-6">
                           <input class="btn btn-default btn-lg btn-qty " name="quantidade" type="number" value="1">
                        </div>
                        <div class="col-xs-6">
                            <input class="btn btn-success btn-lg btn-brand btn-full-width" name="comprar" value="Comprar" type="submit" <?php if($produto->estoque == 0){echo('disabled');}?>>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Instituto Federal Catarinense de Educação, Ciência e Tecnologia</p>
    </div>
    <!-- /.container -->
</footer>

</body>

</html>
