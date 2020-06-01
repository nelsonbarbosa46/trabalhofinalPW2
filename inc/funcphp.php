<?php

session_start();
require "mysql.php";

if (isset($_POST['postupvote'])) {
    $objJSON = $_POST['postupvote'];
    $obj = json_decode($objJSON);
    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        //converter para inteiro
        $idpost=(int)$obj->post;
        if (is_numeric($idpost)) { 
            $resultado=upVotePost($idpost, $_SESSION['userid']);
            echo '{"resultado" : "'.$resultado.'"}';
        }
    }
}

if (isset($_POST['postdownvote'])) {
    $objJSON = $_POST['postdownvote'];
    $obj = json_decode($objJSON);

    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        //converter para inteiro
        $idpost=(int)$obj->post;
        if (is_numeric($idpost)) { 
            $resultado=upDownPost($idpost, $_SESSION['userid']);
            echo "{\"resultado\" : \"".$resultado."\"}";
        }
    }
}