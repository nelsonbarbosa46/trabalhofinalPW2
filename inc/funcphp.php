<?php

require "mysql.inc.php";

if (isset($_POST['postupvote'])) {
    $objJSON = $_POST['postupvote'];
    $obj = json_decode($objJSON);
    if (isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])) {
        //converter para inteiro
        $idpost=(int)$obj->post;
        if (is_numeric($idpost)) { 
            $resultado=upVotePost($idpost, $_SESSION['iduser']);
            echo '{"resultado" : "'.$resultado.'"}';
        }
    }
}

if (isset($_POST['postdownvote'])) {
    $objJSON = $_POST['postdownvote'];
    $obj = json_decode($objJSON);
    if (isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])) {
        //converter para inteiro
        $idpost=(int)$obj->post;
        if (is_numeric($idpost)) { 
            $resultado=upDownPost($idpost, $_SESSION['iduser']);
            echo "{\"resultado\" : \"".$resultado."\"}";
        }
    }
}

if (isset($_POST['criarPost'])) {

    /*
    0: nao deu erro
    1: deu erro (vem da funcao createPost())
    2: erro na sessao do user
    3: campos vazios
    */
    $erro = 0;

    $post = $_POST['post'];
    $title = $_POST['titulo'];
    if (isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])) {
        if (!empty($post) && !empty($title)) {
            $erro = createPost($title, $post, $_SESSION['iduser']);
        } else {
            $erro = 3;
        }
    } else {
        $erro = 2;
    }
    
    switch ($erro) {
        case 0:
            header("Location: ../index.php?criadocomsucesso");
            break;
        case 1:
            header("Location: ../index.php?erro");
            break;
        case 2:
            header("Location: ../index.php?errosessao");
            break;
        case 3:
            header("Location: ../index.php?camposvazios");
            break;
        default:
            header("Location: ../index.php?erro");
            break;
    }
}