<?php

require "mysql.inc.php";

if (isset($_POST['criarUser'])) {

	$username=$_POST['registeruser'];
	$email=$_POST['registeremail'];
	$password=$_POST['registerpass'];
    $password2=$_POST['registerpass2'];
    /*
    0: nao deu erro
    1: deu erro (vem da funcao createrUser())
    2: já existinte o registo (vem da funcao createrUser())
    3: campos vazios
    4: campo username tem caracteres invalidos
    5: email invalido
    6: password2 nao e igual a password
    */
    $erro = 0;
    
	if (empty($username) || empty($email) || empty($password) || empty($password2)) {
		$erro = 3;
	} elseif (1 === 2/*!preg_match("/^[a-z\d_]{2,20}$/i", $username)*/) {
		$erro = 4;
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 5;
    } else {
        if ($password2 === $password) {
            $erro = createUser($username, $email, $password);
        } else {
            $erro = 6;
        }
    }
    switch ($erro) {
        case 0:
            header("Location: ../index.php?criadocomsucesso");
            break;
        case 1:
            header("Location: ../index.php?erro");
            break;
        case 2:
            header("Location: ../index.php?jaexiste");
            break;
        case 3:
            header("Location: ../index.php?camposvazios");
            break;
        case 4:
            header("Location: ../index.php?caracteresinvalidos");
            break;
        case 5:
            header("Location: ../index.php?emailinvalido");
            break;
        case 6:
            header("Location: ../index.php?passwordsnaocoincidem");
            break;
        default:
            header("Location: ../index.php?erro");
            break;
    }
}

if (isset($_POST['loginUser'])) {

    $email = $_POST['loginemail'];
    $password = $_POST['loginpass'];

    /*
    0: nao deu erro
    1: deu erro (vem da funcao createrUser())
    2: password nao coincide (vem da funcao createrUser())
    3: nao encontrado (vem da funcao createrUser())
    4: campos vazios
    */
    $erro = 0;

    if (empty($email) || empty($password)) {
        $erro = 4;
    } else {
        $erro = loginUser($email, $password);
    }

    switch ($erro) {
        case 0:
            header("Location: ../index.php?loginefetuadocomsucesso");
            break;
        case 1:
            header("Location: ../index.php?erro");
            break;
        case 2:
            header("Location: ../index.php?passwordnaocoincide");
            break;
        case 3:
            header("Location: ../index.php?naoencontrado");
            break;
        case 4:
            header("Location: ../index.php?camposvazios");
            break;
        default:
            header("Location: ../index.php?erro");
            break;
    }
}