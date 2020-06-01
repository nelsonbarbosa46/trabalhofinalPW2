<?php

if (isset($_POST['log'])) {

  require 'dbc.inc.php';

  $user = $_POST['user'];
  $password = $_POST['password'];

  if (empty($user) || empty($password)) {
    header("Location: ../login.php?camposvazios");
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE user=?;";
    $stmt = mysqli_stmt_init($conex);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../login.php?erro");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $user);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $passwordcheck= password_verify($password, $row['password']);
        if ($passwordcheck == false) {
          header("Location: ../login.php?erro");
          exit();
        }
        elseif ($passwordcheck == true) {
          session_start();
          $_SESSION['nomeuser'] = $row['nomeuser'];
          header("Location: ../admi/index.php?sucesso");
          exit();
        }
        else {
          header("Location: ../login.php?erro");
          exit();
        }
      }
      else {
        header("Location: ../login.php?erro");
        exit();
      }
    }
  }
}
else {
  header("Location: ../login.php?erro");
  exit();
}
