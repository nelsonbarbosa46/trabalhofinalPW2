<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="inc/users.inc.php" method="post" id="loginform">
            <h4 class="p-3 text-center">Iniciar Sessão</h4> 
            <div class="md-form">
              <input type="email" id="loginemail" name="loginemail" class="form-control">
              <label for="loginemail">Email</label>
            </div>
            <div class="md-form">
              <input type="password" id="loginpass" name="loginpass" class="form-control">
              <label for="loginpass">Palavra-passe</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="lembrar">
              <label class="custom-control-label" for="lembrar">Lembrar</label>
            </div>
            <div class="text-center pt-3">
              <p>Ainda não tem conta, <a id="criaruser" href="#">clique aqui.</a></p>
              <button type="submit" name="loginUser" class="btn btn-login">Login</button>
            </div>
        </form>
        <form action="inc/users.inc.php" method="post" id="registerform">
            <h4 class="p-3 text-center">Registar</h4>
            <div class="md-form">
                <input type="text" id="registeruser" name="registeruser" class="form-control">
                <label for="registeruser">Utilizador</label>
            </div>
            <div class="md-form">
                <input type="email" id="registeremail" name="registeremail" class="form-control">
                <label for="registeremail">Email</label>
            </div>
            <div class="md-form">
                <input type="password" id="registerpass" name="registerpass" class="form-control">
                <label for="registerpass">Palavra-passe</label>
            </div>
            <div class="md-form">
                <input type="password" id="registerpass2" name="registerpass2" class="form-control">
                <label for="registerpass2">Repetir Palavra-passe</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="lembrarLogin">
                <label class="custom-control-label" for="lembrarLogin">Lembrar</label>
            </div>
            <div class="text-center pt-3">
                <p>Já tem conta, efetue <a id="loginuser" href="#">o login aqui.</a></p>
                <button type="submit" id="registerbtn" name="criarUser" class="btn btn-login">Registar</button>
            </div>
        </form>
    </div>
    </div>
</div>
</div>

<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="#"> <img src="img/Logo-e-nome-B.png" width="85px"> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto"> 
        
            <?php
            if (!empty($_SESSION['nomeuser'])) {
              echo '
              <li class="nav-item dropdown">
                <a class="btn btn-login dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">'.$_SESSION['nomeuser'].'</a>
                <div class="dropdown-menu" style="width: 50px" aria-labelledby="navbarDropdownUser">
                  <form method="post" action="inc/logout.inc.php">
<<<<<<< Updated upstream
                 <button class="btn btn-link dropdown-item" type="submit">Sair</button>
                </form>
=======
                    <button class="btn btn-link dropdown-item" type="submit">Sair</button>
                  </form>
>>>>>>> Stashed changes
                </div>
              </li>
              ';
            } else {
              echo '
              <li class="nav-item">
                <button type="button" class="btn btn-login" id="btnmodal" data-toggle="modal" data-target="#modalLogin">
                Login
                </button>
              </li>';
            }
            ?>
    </ul>
  </div>
</nav>
