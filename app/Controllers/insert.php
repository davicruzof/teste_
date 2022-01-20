<?php

    require __DIR__ . "/../../vendor/autoload.php";

    $error = valida_post();

    use App\Entity\User;

    session_start();

    if (count($error) == 0) {

        $user = new User();

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $password2 = filter_input(INPUT_POST, 'senha2', FILTER_SANITIZE_STRING);

        if($password != $password2) {

            $_SESSION['error-register'] = "Senhas diferentes!";
            header('Location: create');
            return;
        }

        $resultGet = $user->getUser($email);

        if($resultGet){
            $_SESSION['error-register'] = 'Esse usuário já está cadastrado';
            header('Location: create');
            return;
        }

        $user->nome = addslashes($nome);
        $user->email = addslashes($email);
        $user->password = addslashes($password);
        $user->insertUser();

        unset($_SESSION['error-register']);

        header('Location: index');

    } else {
        $_SESSION['error-register'] = 'Preencha todos os campos';
        header('Location: create');
    }

    function valida_post()
    {
        $errors = [];

        if (!isset($_POST['nome']) || empty($_POST['nome']))
            array_push($errors, "Preencha o nome completo");
        if (!isset($_POST['email']) || empty($_POST['email']))
            array_push($errors, "Preencha o email");
        if (!isset($_POST['senha']) || empty($_POST['senha']))
            array_push($errors, "Preencha a senha");
        if (!isset($_POST['senha2']) || empty($_POST['senha2']))
            array_push($errors, "Preencha a senha novamente");

        return $errors;

    }

