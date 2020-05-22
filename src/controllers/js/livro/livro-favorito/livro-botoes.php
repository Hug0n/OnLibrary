<?php
session_start();
loadModel('Livro');


$id_livro = $_POST['id_livro'];
$id_usuario = $_SESSION['usuario']->id_usuario;

//teste com sucesso. Passei o objeto
// $LivroObj = isset($_POST['livro']) ? $_POST['livro'] : null;

$Livro = new Livro([]);

$resultadoFavoritados = $Livro->getResultSetFromSelect(['id_usuario_favorito' => $id_usuario, 'id_livro_favorito' => $id_livro], '*', 'livro_favorito');

// $sql = "SELECT *  FROM livro_favorito WHERE id_usuario_favorito = $id_usuario AND id_livro_favorito = $id_livro; 

$btn_favorito = 'block';
$btn_excluir_favorito = 'block';

if ($resultadoFavoritados) {
    $btn_favorito = 'none';
} else {
    $btn_excluir_favorito = 'none';
}


echo '<div class="row coluna-seguidor-btn">
            <div class="col-md-12 ">
                <button type="button" style="display: ' . $btn_excluir_favorito . '" class="btn btn-danger btn-block" id="btn_removerfavorito">REMOVER DOS FAVORITOS -</button>
            </div>
          </div>';

echo '<div class="row coluna-seguidor-btn ">
          <div class="col-md-12 ">
              <button type="button" style="display: ' . $btn_favorito . '" class="btn btn-warning btn-block" id="btn_addfavorito">ADICIONAR AOS FAVORITOS +</button>
          </div>
      </div>';

echo '<div class="row coluna-seguidor-btn ">
        <div class="col-md-12 ">
            <button type="button" class="btn btn-success btn-block">ALUGAR</button>
        </div>
      </div>';

echo '<div class="row coluna-seguidor-btn ">
        <div class="col-md-12 ">
            <button type="button" class="btn btn-info btn-block">COMPRAR</button>
        </div>
      </div>';


echo '<hr>
            <div class="row">
				<!-- Início (row) da 2° coluna -->
				<div class="col-md-6">
					LERAM <br>10
                    <?php  ?>
				</div>
				<div class="col-md-6">
					LENDO <br> 2
                    <?php ?>
				</div>
				<div class="col-md-6">
					QUEREM LER <br> 6
                    <?php  ?>
                </div>
                <div class="col-md-6">
					FAVORITARAM <br> 10
                    <?php  ?>
                </div>
                <div class="col-md-12">
					RESENHAS <br>2
                    <?php  ?>
                </div>
                </div>
               ';
