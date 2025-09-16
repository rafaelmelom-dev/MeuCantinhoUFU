<?php
include 'config.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $senha = htmlspecialchars(trim($_POST['senha']));

    $stmt = $pdo->prepare('SELECT id_anunciante, nome, email, senha, foto_caminho FROM Anunciante WHERE email = ?;');
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($user && password_verify($senha, $usuario['senha'])) {
        $_SESSION['id_anunciante'] = $usuario['id_anunciante'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['foto_perfil'] = $usuario['foto_caminho'];

        header('Location: index.php');
        exit;
    }

    header('Location: index.php');
}


header('Location: index.php');

