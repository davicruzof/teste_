<?php
    session_start();

    if(!empty($_SESSION) && isset($_SESSION["success"]) && $_SESSION["success"] == 'ativo'){
        header("Location: index");
        return;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <div class="login-logo">
                <a href="login.php"><b>Login</a>
            </div>

            <p class="login-box-msg">Inicie uma nova sessão</p>

            <form action="entrar" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-2">
                    <input type="password" class="form-control" name="senha" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mb-3">
                    <?php

                        if(!empty($_SESSION) && isset($_SESSION["error"])){
                            echo "<span class='text-danger'>{$_SESSION['error']}</span>";
                        }
                    ?>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>
            </form>

            <p class="d-flex justify-content-center mt-2">
                <a href="create" class="text-center">Cadastrar novo usuário</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
