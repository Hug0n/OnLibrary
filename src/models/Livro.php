<?php

class Livro extends Model
{
    public $nomeLivro;
    public $autor;
    public $ano;
    public $descricao;
    public $categoria;
    public $dataPrazoAluguel;
    public $foraDeLinha;
    public $idioma;
    public $numeroEdicao;
    public $quantidadePaginas;


    protected static $tableName = 'livro'; //usado pra pegar o nome da tabela no model
    protected static $columns = [
        'id_livro',
        'nome_livro',
        'autor',
        'ano',
        'sinopse',
        'data_prazo_aluguel',
        'categoria',
        'fora_de_linha',
        'idioma',
        'numero_edicao',
        'quantidade_paginas',
    ];



    function getComent($id_livro)
    {
        $sql = " SELECT * FROM comentario_livro INNER JOIN usuario ON ID_USUARIO_COMENTOU = usuario.id_usuario WHERE ID_LIVRO_COMENTADO = $id_livro ORDER BY DATA_COMENTARIO DESC";

        $conn = Database::executarSQL($sql);

        if ($conn) {
            $resultado_comments = mysqli_query($conn, $sql);
            return $resultado_comments;
        } else {
            echo "erro no query da classe Livro (getComent())!";
        }

    }
}
