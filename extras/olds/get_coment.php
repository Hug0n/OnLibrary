<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php?erro=1');
}

require_once('class.db.php');

$id_usuario = $_SESSION['id_usuario'];

$id_livro = $_POST['id_livro'];

$objDb = new db();
$link = $objDb->conecta_mysql();


$sql = " SELECT * FROM comentario_livro INNER JOIN usuario ON ID_USUARIO_COMENTOU = usuario.id_usuario WHERE ID_LIVRO_COMENTADO = $id_livro ORDER BY DATA_COMENTARIO DESC";


$resultado_id = mysqli_query($link, $sql);



if ($resultado_id) {
    while ($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)) {
        echo '<a href="#" class="list-group-item" style= border-radius:20px 50px 30px >';

        if ($id_usuario === $registro['id_usuario']) {
            echo '<button type="button"  id="btn_excluir_coment_'.$registro['COD_COMENTARIO'].'" class="btn btn-default btn_excluir_coment pull-right" data-cod_comentario="'.$registro['COD_COMENTARIO'].'"> Excluir </button>';
        }

        echo '<h4 class="list-group-item-heading"> ' . $registro['nome'] . ' <small> - ' . date('d \d\e M \d\e Y', strtotime($registro['DATA_COMENTARIO']))  . '</small> </h4>';
        echo '<p class = list-group-item-text>' . $registro['COMENTARIO'] . '</p>';
        echo '</a>';
    }
} else {
    echo 'Erro na consulta dos posts no banco de dados. Por favor, tente novamente.';
}
