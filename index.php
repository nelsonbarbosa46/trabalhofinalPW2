<?php
session_start();



$posts = '';
//configuracao para a data
date_default_timezone_set('Europe/Lisbon');
require "inc/dbc.inc.php";
$sql = "SELECT * FROM POSTS";
$result = $conex->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataBD = new DateTime($row['date']);
        $dataAtual = new DateTime(date("Y-m-d H:i:s"));
        $resultadoDatas = $dataBD->diff($dataAtual);
        $posts .= '<article class="container p-3">
            <div class="card">
                <div class="card-body row">
                    <div class="col-md-1 votes">
                        <form id=post' . $row['id'] . '>
                            <a class="up"><i class="fas fa-caret-up"></i></a><br>
                            <a class="down"><i class="fas fa-caret-down"></i></a>
                        </form>
                    </div>
                    <div class="col-md-11">
                        <span class="text-muted text-showinfo">' . $resultadoDatas->format('publicado há %a dias atrás') . '</span>
                        <h4>' . $row['title'] . '</h4>
                        <div>
                            ' . $row['content'] . '
                        </div>
                    </div>
                </div>
        </article>';
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <?php require "style.php" ?>

</head>

<body>
    <?php require "navbar.php"; ?>
    <main class="pt-5">
        <section id="inicio">

        </section>
        <?php echo $posts; ?>
        <aside>

        </aside>
    </main>
    <footer>

    </footer>

</body>

</html>