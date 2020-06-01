<?php
session_start();
session_unset();
session_destroy();
setcookie('nomeuser', null, -1, '/'); 
setcookie('iduser', null, -1, '/');
header("Location: ../index.php?terminadosessao");