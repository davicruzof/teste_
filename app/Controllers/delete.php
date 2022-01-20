<?php

    session_start();

    require __DIR__ . "/../../vendor/autoload.php";

    if (!isset($_GET['id_user']) && !is_numeric($_GET['id_user'])) {
        $_SESSION['error'] = json_encode(["Erro cliente não permitido"]);
        echo "<script>history.back()</script>";
        return;
    }

    use App\Entity\User;

    (new User())->deleteUser($_POST['id_user']);

    header("Location: index");