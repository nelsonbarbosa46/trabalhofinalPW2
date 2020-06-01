<?php
session_start();
require "dbc.inc.php";

function upVotePost($idpost, $iduser)
{
    global $conex;
    /*variavel a retornar se funcionou ou nao, retornando um numero; 0=nao funcionou; 
    0: erro;
    1: criar um registo
    2: alterar o registo
    3: remover o registo
    */
    $varReturn = 0;
    $upVote = 1;
    //verificar se ja tem alguma upvote neste post, se tiver a pessoa quer tirar o voto
    $sqlcheckupvote = "SELECT * FROM VOTEPOSTS WHERE idpost=? AND iduser=? AND vote=?";
    $stmt = $conex->stmt_init();
    if ($stmt->prepare($sqlcheckupvote)) {
        /* atribui os parâmetros aos marcadores */
        $stmt->bind_param("iii", $idpost, $iduser, $upVote);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            //é para eliminar o voto na BD
            $sqldelvote= "DELETE FROM VOTEPOSTS WHERE idpost=? AND iduser=? AND vote=?";
            if ($stmt->prepare($sqldelvote)) {
                $stmt->bind_param("iii", $idpost, $iduser, $upVote);
                $stmt->execute();
                $varReturn=3;
            }
        } else {
            //verificar se existe ja algum voto no post
            $sqlcheckvote="SELECT * FROM VOTEPOSTS WHERE idpost=? AND iduser=?";
            if ($stmt->prepare($sqlcheckvote)) {
                $stmt->bind_param("ii", $idpost, $iduser);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    //é para alterar o voto
                    $sqlcheckvote="UPDATE VOTEPOSTS SET vote=? WHERE idpost=? AND iduser=?";
                    if ($stmt->prepare($sqlcheckvote)) {
                        $stmt->bind_param("iii", $upVote, $idpost, $iduser);
                        $stmt->execute();
                        $stmt->store_result();
                        $varReturn=2;
                    }
                } else {
                    //é para add na BD
                    $sqlcheckvote="INSERT INTO VOTEPOSTS (idpost, iduser, vote) VALUES (?,?,?)";
                    if ($stmt->prepare($sqlcheckvote)) {
                        $stmt->bind_param("iii", $idpost, $iduser, $upVote);
                        $stmt->execute();
                        $stmt->store_result();
                        $varReturn=1;
                    }
                }
            }
        }
    }
    $stmt->close();
    $conex->close();
    return $varReturn;
}

function upDownPost($idpost, $iduser)
{
    global $conex;
    /*variavel a retornar se funcionou ou nao, retornando um numero
    0: erro;
    1: criar um registo
    2: alterar o registo
    3: remover o registo
    */
    $varReturn = 0;
    $downVote = 2;
    //verificar se ja tem alguma upvote neste post, se tiver a pessoa quer tirar o voto
    $sqlcheckupvote = "SELECT * FROM VOTEPOSTS WHERE idpost=? AND iduser=? AND vote=?";
    $stmt = $conex->stmt_init();
    if ($stmt->prepare($sqlcheckupvote)) {
        /* atribui os parâmetros aos marcadores */
        $stmt->bind_param("iii", $idpost, $iduser, $downVote);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            //é para eliminar o voto na BD
            $sqldelvote= "DELETE FROM VOTEPOSTS WHERE idpost=? AND iduser=? AND vote=?";
            if ($stmt->prepare($sqldelvote)) {
                $stmt->bind_param("iii", $idpost, $iduser, $downVote);
                $stmt->execute();
                $varReturn=3;
            }
        } else {
            //verificar se existe ja algum voto no post
            $sqlcheckvote="SELECT * FROM VOTEPOSTS WHERE idpost=? AND iduser=?";
            if ($stmt->prepare($sqlcheckvote)) {
                $stmt->bind_param("ii", $idpost, $iduser);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    //é para alterar o voto
                    $sqlcheckvote="UPDATE VOTEPOSTS SET vote=? WHERE idpost=? AND iduser=?";
                    if ($stmt->prepare($sqlcheckvote)) {
                        $stmt->bind_param("iii", $downVote, $idpost, $iduser);
                        $stmt->execute();
                        $stmt->store_result();
                        $varReturn=2;
                    }
                } else {
                    //é para add na BD
                    $sqlcheckvote="INSERT INTO VOTEPOSTS (idpost, iduser, vote) VALUES (?,?,?)";
                    if ($stmt->prepare($sqlcheckvote)) {
                        $stmt->bind_param("iii", $idpost, $iduser, $downVote);
                        $stmt->execute();
                        $stmt->store_result();
                        $varReturn=1;
                    }
                }
            }
        }
    }
    $stmt->close();
    $conex->close();
    return $varReturn;
}

function createUser($username, $email, $password) {
    global $conex;
    /*
    0: não deu erro
    1: deu erro
    2: já existinte o registo
    */
    $erro = 1;
    $sqlCheck="SELECT email FROM USERS WHERE email=?";
    $stmt = $conex->stmt_init();
    if ($stmt->prepare($sqlCheck)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $erro=2;
        } else {
            $sqlInsert = "INSERT INTO USERS (username, email, pass) VALUES (?,?,?)";
            if ($stmt->prepare($sqlInsert)) {
                $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param("sss", $username, $email, $hashedpwd);
                $stmt->execute();
                $stmt->store_result();
                $erro = loginUser($email,$password);
            }
        }
    }
    $stmt->close();
    $conex->close();
    return $erro;
}

function loginUser($email, $password) {

    global $conex;

    /*variavel a retornar se funcionou ou nao, retornando um numero
    0: funcionou
    1: erro
    2: password nao coincide
    3: nao existe
    */
    $erro = 1;

    $sqlCheck = "SELECT * FROM users WHERE email=?";
    $stmt = $conex->stmt_init();
    if ($stmt->prepare($sqlCheck)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $passwordCheck= password_verify($password, $row['pass']);
            if ($passwordCheck === true) {
                $_SESSION['nomeuser'] = $row['username'];
                $_SESSION['iduser'] = $row['iduser'];
                $erro = 0;
            } else {
                $erro = 2;
            }
        } else {
            $erro = 3;
        }
    }
    $stmt->close();
    $conex->close();
    return $erro;
}