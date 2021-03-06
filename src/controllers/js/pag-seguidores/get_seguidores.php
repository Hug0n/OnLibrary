<?php
session_start();

$id_usuario = $_SESSION['usuario']->id_usuario;

$Usuario = new Usuario([]);

$resultadoGetPessoas = $Usuario->getResultSetFromSelect(['id_usuario' => $id_usuario], '*', 'usuario_seguidores');

// Lógica -> seguindo
// SELECT * FROM usuario_seguidores LEFT JOIN usuario ON usuario.id_usuario = usuario_seguidores.id_usuario_que_sigo WHERE usuario_seguidores.id_usuario = 84


// $diretorio = $Usuario->getDiretorioImagemUser();


$qnt_linhas = mysqli_num_rows($resultadoGetPessoas);


if ($resultadoGetPessoas) {
    if($qnt_linhas > 0) {

        while ($registro = mysqli_fetch_array($resultadoGetPessoas, MYSQLI_ASSOC)) {
            echo '<div class="row list-group-users">';

            echo '<div class="col-md-3">';
            echo '<a href="pag-perfil-usuario.php?idUsuario=' . $registro['id_usuario'] . '" class="text">';
            echo '<div class="imagem-user-peq">';
            echo '<img src="' . $diretorio . $registro['imagem_usuario'] . '">';
            echo '</div>';
            echo '</a>';

            echo '</div>';

            echo '<div class="col-md-9">';
            echo '<a href="pag-perfil-usuario.php?idUsuario=' . $registro['id_usuario'] . '" class="text">';

            echo '<strong> ' . $registro['nome'] . ' </strong> <small> -  ' . $registro['email'] . '  </small>';
            echo '<p class="list-group-item-text pull-right">';
            echo '</a>';


            $esta_seguindo_usuario_tf = $Usuario->getPessoasBotao($id_usuario, $registro['id_usuario']);

            // $sql2 = "SELECT *  FROM usuario_seguidores WHERE id_usuario = $id_usuario AND id_usuario_que_sigo =".$registro['id_usuario'];

            $registro2 = mysqli_fetch_array($esta_seguindo_usuario_tf, MYSQLI_ASSOC);


            $btn_seguir_display = 'block';
            $btn_deixar_seguir_display = 'block';

            if (!(is_array($registro2))) {
                $btn_deixar_seguir_display = 'none';
            } else {
                $btn_seguir_display = 'none';
            }

            echo '<button type="button" id="btn_seguir_' . $registro['id_usuario'] . '" style="display: ' . $btn_seguir_display . '" class="btn btn-default btn_seguir" data-id_usuario="' . $registro['id_usuario'] . '"> Seguir </button>';
            echo '<button type="button" id="btn_deixar_seguir_' . $registro['id_usuario'] . '" style="display: ' . $btn_deixar_seguir_display . '" class="btn btn-primary btn_deixar_seguir" data-id_usuario="' . $registro['id_usuario'] . '"> Deixar de Seguir </button>';



            echo '</p>';
            echo '</div>'; //Fim coluna 2
            echo '</div>'; //Fim row

        }
    }else {
        echo '<br>';
        echo '<br>';

        echo 'Não encontramos nenhum usuário com esse nome...Que tal tentar novamente? =D';
        echo '<br>';

    }
} else {
    echo 'Erro na consulta dos usuários no banco de dados. Por favor, tente novamente!!!';
}

