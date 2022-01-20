<?php

    session_start();

    if(empty($_SESSION) || !isset($_SESSION["success"]) || $_SESSION["success"] != 'ativo'){
        header("Location: login");
    }

    require __DIR__ . '/vendor/autoload.php';

    use App\Entity\User;

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <title>Document</title>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="p-5">
    <div class="row">
        <div class="col-2 mb-5 mr-2">
            <a href="create" type="button" class="btn btn-block btn-primary">Novo</a>
        </div>

        <div class="col-2 mb-5">
            <a href="sair" type="button" class="btn btn-block btn-primary">Sair</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <?php

                    $users = (new User())->getUsers();

                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->nome ?></td>
                            <td><?= $user->email ?></td>
                            <td>
                                <form action="edit" method="post">
                                    <label for="editar_button<?= $user->id ?>">
                                        <a><i class="nav-icon fas fa-edit"></i></a>
                                    </label>
                                    <input type="hidden" name="id_user"  value="<?= $user->id ?>" />
                                    <input type="submit" id="editar_button<?= $user->id ?>" style="display: none" />
                                </form>
                            </td>
                            <td>
                                <form action="delete" method="post">
                                    <label for="delete_button<?= $user->id ?>">
                                        <a><i class="nav-icon fas fa-trash"></i></a>
                                    </label>
                                    <input type="hidden" name="id_user"  value="<?= $user->id ?>" />
                                    <input type="submit" id="delete_button<?= $user->id ?>" style="display: none" />
                                </form>
                            </td>
                        </tr>
                        <?php
                    }

                ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
</div>

</body>

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</html>