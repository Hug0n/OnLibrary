<?php 

    session_start();
    
    if(!isset($_SESSION['email'])){
        header('Location: index.php?erro=1');
    }

    require_once('class.db.php');

    $id_livro = $_POST['id_livro'];
    $texto_post = $_POST['texto_post'];
    $id_usuario = $_SESSION['id_usuario'];
    
        if($texto_post == '' || $id_usuario == '') {
             die(); 
            //Lógica que impede continuar o registro caso uma das variáveis estejam vazias.
        }
        
    var_dump($id_livro);
    $objDb = new db();
    $link = $objDb -> conecta_mysql();
    
    $sql = "INSERT INTO COMENTARIO_LIVRO(ID_LIVRO_COMENTADO, ID_USUARIO_COMENTOU, COMENTARIO) values ($id_livro,$id_usuario, '$texto_post')";
    
    mysqli_query($link, $sql);




?> 