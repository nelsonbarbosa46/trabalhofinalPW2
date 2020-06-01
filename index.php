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
        $dataBD = new DateTime($row['datecreated']);
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
        <section class="container">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseCriarPost" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-plus"></i> Criar Post
            </button>
            <div class="collapse" id="collapseCriarPost">
                <div class="card card-body">
                    <form action="inc/funcphp.php" method="post">
                        <div class="md-form">
                            <input type="text" id="titulo" name="titulo" class="form-control">
                            <label for="titulo">Título</label>
                        </div>
                        <div class="md-form">
                            <textarea name="post" id="createPost" class="md-textarea form-control" cols="30" rows="5"></textarea>
                            <label for="form7">Criar Post</label>
                        </div>
                        <button type="submit" name="criarPost" class="btn btn-login btn-block">Criar Post</button>
                    </form>
                </div>
            </div>

        </section>
        <?php echo $posts; ?>
        <aside>

        </aside>
    </main>
    <footer>

    </footer>

</body>

</html>