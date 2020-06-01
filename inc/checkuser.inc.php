<?php
    session_start();
    $user=$_SESSION['nomeuser'];
    require '../inc/dbc.inc.php';
    if (empty($user)) {
        header("Location: ../index.php");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE nomeuser=?;";
        $stmt = mysqli_stmt_init($conex);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php");
        exit();
        } else {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $total=mysqli_stmt_num_rows($stmt);
        if (0 >= $total) {
            header("Location: ../index.php");
            exit();
        }
        }
    }

?>