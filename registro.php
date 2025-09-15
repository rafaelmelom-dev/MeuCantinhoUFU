<?php 
    include 'config.php';
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $descricao = $_POST['descricao'] ?? '';
        $senha = $_POST['senha'];
        $senha_confirm = $_POST['senha_confirm'];

        if ($senha !== $senha_confirm) {
            $_SESSION['error_message'] = 'Senha não coincide a confirmação';
            header("Location: index.php");
            exit;
        }

        // upload da imagem
        $foto_caminho = '';
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
            $upload_dir = 'uploads/perfis/';
            $file_info = pathinfo($_FILES['foto_perfil']['name']);
            $file_ext = strtolower($file_info['extension']);
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($file_ext, $allowed_exts)) {
                $novo_nome_arquivo = uniqid('perfil_', true) . '.' . $file_ext;
                $foto_caminho = $upload_dir . $novo_nome_arquivo;

                if (!move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $foto_caminho)) {
                    $_SESSION['error_message'] = 'Erro ao fazer upload da imagem: ';
                    header('Location: index.php');
                    exit;
                }
            } else {
                $_SESSION['error_message'] = 'Formato de arquivo de imagem inválido.';
                header('Location: index.php');
                exit;
            }
        } else {
            $_SESSION['error_message'] = 'É necessário enviar uma foto de perfil.';
            header('Location: index.php');
            exit;
        }

        $senha_crypt = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $sql = 'INSERT INTO Anunciante (nome, descricao, foto_caminho, email, telefone, senha) VALUES (?, ?, ?, ?, ?, ?);';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $descricao, $foto_caminho, $email, $telefone, $senha_crypt]);

            $_SESSION['success_message'] = 'Cadastro realizado com sucesso! Faça o login.';
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['error_message'] = 'Este email já está cadastrado.';
            } else {
                $_SESSION['error_message'] = 'Erro ao cadastrar: ' . $e->getMessage();
            }

            if (file_exists($foto_caminho)) {
                unlink($foto_caminho);
            }
            header('Location: index.php');
            exit;
        }
    } else {
        header('Location: index.php');
        exit;
    }
?>