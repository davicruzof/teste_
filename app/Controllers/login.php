<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Entity\User;
    session_start();

    if(empty($_POST)){
        header('Location: login');
        return;
    }

    $data = $_POST;

    $user = (new User())->signIn($data);

    if($user){
        $_SESSION['success'] = "ativo";
        unset($_SESSION['error']);
        header('Location: index');
    }else{
        $_SESSION['success'] = "desativo";
        $_SESSION['error'] = 'Email ou senha inválido';
        header('Location: login');
    }
