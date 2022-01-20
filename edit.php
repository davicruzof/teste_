<?php
    session_start();

    if(empty($_SESSION) || !isset($_SESSION["success"]) || $_SESSION["success"] != 'ativo'){
        header("Location: login");
    }

    require __DIR__ . '/vendor/autoload.php';

    use App\Entity\User;

    if (!isset($_POST['id_user']) || empty($_POST['id_user'])){
        return;
    }

    $user = (new User())->getUserById($_POST['id_user']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed register-page">
<div class="register-box">

    <div class="card">
        <div class="card-body register-card-body">
            <div class="register-logo">
                <a href="/">Cadastro</a>
            </div>
            <p class="login-box-msg">Cadastro de novo usuário</p>

            <?php

                if(!empty($_SESSION) && isset($_SESSION["error"])){
                    echo "<span class='text-danger'>{$_SESSION['error']}</span>";
                }
            ?>

            <form action="editar" method="post">
                <label>Nome</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nome" value="<?= $user->nome ?>" placeholder="Nome">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <label>Email</label>
                <input name="id_user"  value="<?= $user->id?>" type="hidden">
                <div class="input-group mb-3">
                    <input type="email" class="form-control"  value="<?= $user->email ?>" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <label>Senha</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="senha" placeholder="Senha">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Editar</button>
                </div>
            </form>

            <div  class="mt-3 w-100 justify-content-center d-flex">
                <a href="index">Voltar</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
