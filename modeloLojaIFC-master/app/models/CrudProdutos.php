<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 16/11/2017
 * Time: 10:56
 */

require_once "Conexao.php";
require_once "Produto.php";

class CrudProdutos
{

    private $conexao;
    public $produto;

    public function __construct()
    {
        $this->conexao = Conexao::getConexao();
    }

    public function salvar(Produto $produto)
    {
        $sql = "INSERT INTO tb_produtos (nome, preco, categoria, estoque) VALUES ('$produto->nome', $produto->preco, '$produto->categoria', $produto->estoque)";

        $this->conexao->exec($sql);
    }

    public function getProduto(int $codigo)
    {
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos WHERE codigo = $codigo");
        $produto = $consulta->fetch(PDO::FETCH_ASSOC); //SEMELHANTES JSON ENCODE E DECODE

        return new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto ['estoque'], $produto['codigo']);

    }

    public function getProdutos()
    {
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos");
        $arrayProdutos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //Fabrica de Produtos
        $listaProdutos = [];
        foreach ($arrayProdutos as $produto) {
            $listaProdutos[] = new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto ['estoque'], $produto['codigo']);
        }

        return $listaProdutos;

    }

    public function excluirProdutos(int $codigo)
    {

        $this->conexao->query("DELETE FROM tb_produtos WHERE codigo = $codigo");
    }

    public function editar($id, $nome, $categoria, $preco, $estoque)
    {

        $this->conexao->exec("UPDATE `tb_produtos` SET `nome` = '$nome', `categoria` = '$categoria', `preco` = '$preco', `estoque` = '$estoque' WHERE `tb_produtos`.`codigo` = $id; ");

    }

    public function Comprar(int $codigo, int $quantidade)
    {
        if(empty($quantidade)){
            return "Sua compra está vazia";
        }

        if ($quantidade > $this->getProduto($codigo)->estoque) {
            return "Não seja guloso";
        } else {

            $novoEstoque = $this->getProduto($codigo)->estoque - $quantidade;

            $this->conexao->exec("UPDATE `tb_produtos` SET `estoque` = $novoEstoque WHERE `codigo` = $codigo");

            return "Isso aí";
        }

    }

}


