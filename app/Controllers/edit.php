<?php

    require __DIR__ . "/../../vendor/autoload.php";

    if (!isset($_GET['id_user']) && !is_numeric($_GET['id_user'])) {
        $_SESSION['error'] = json_encode(["Erro cliente não permitido"]);
        echo "<script>history.back()</script>";
        return;
    }

    $error = valida_post();

    use App\Entity\User;

    session_start();

    if (count($error) == 0) {

        $user = new User();

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

        $resultGet = $user->getUser($email);

        if(!$resultGet){
            $_SESSION['error'] = 'Esse usuário não está cadastrado!';
            header('Location: edit');
            return;
        }

        $user->nome = addslashes($nome);
        $user->email = addslashes($email);
        if(!empty($password)){
            $user->password = addslashes($password);
        }
        $user->updateUser($_POST['id_user']);

        unset($_SESSION['error']);

        header('Location: index');

    } else {
        $_SESSION['error'] = 'Preencha todos os campos';
        header('Location: edit');
    }

    function valida_post()
    {
        $errors = [];

        if (!isset($_POST['nome']) || empty($_POST['nome']))
            array_push($errors, "Preencha o nome completo");
        if (!isset($_POST['email']) || empty($_POST['email']))
            array_push($errors, "Preencha o email");

        return $errors;

    }

