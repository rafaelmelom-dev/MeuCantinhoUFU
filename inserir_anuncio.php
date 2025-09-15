<?php

include "config.php";
include "db.php";

if (!isset($_SESSION["id_anunciante"])) {
    $_SESSION["error_message"] =
        "Você precisa estar logado para criar um anúncio.";
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["id_anunciante"];
    $desc = htmlspecialchars($_POST["descricao"]);
    $valor = htmlspecialchars($_POST["valor"]);
    $tipo = htmlspecialchars($_POST["tipo_residencia"]);
    $rua = htmlspecialchars($_POST["rua"]);
    $num = htmlspecialchars($_POST["numero"]);
    $bairro = htmlspecialchars($_POST["bairro"]);

    $pdo->beginTransaction();

    try {
        $sql =
            "INSERT INTO Anuncio (id_anunciante, rua, numero, bairro, valor, descricao, tipo_residencia) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id, $rua, $num, $bairro, $valor, $desc, $tipo]);

        $id_anuncio = $pdo->lastInsertId();

        $upload_dir = "uploads/anuncios/";

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (isset($_FILES["imagens"]) && !empty($_FILES["imagens"]["name"])) {
            $sql_i =
                "INSERT INTO Imagens (id_anuncio, imagem_caminho) VALUES (?, ?);";
            $stmt_i = $pdo->prepare($sql_i);

            if (is_array($_FILES["imagens"]["name"])) {
                foreach ($_FILES["imagens"]["tmp_name"] as $key => $tmp_name) {
                    if ($_FILES["imagens"]["error"][$key] === UPLOAD_ERR_OK) {
                        $file_name = $_FILES["imagens"]["name"][$key];
                        $file_tmp = $_FILES["imagens"]["tmp_name"][$key];

                        $file_ext = strtolower(
                            pathinfo($file_name, PATHINFO_EXTENSION),
                        );
                        $novo_nome_arquivo =
                            uniqid("anuncio_" . $id_anuncio . "_", true) .
                            "." .
                            $file_ext;
                        $caminho_completo = $upload_dir . $novo_nome_arquivo;

                        if (move_uploaded_file($file_tmp, $caminho_completo)) {
                            $stmt_i->execute([$id_anuncio, $caminho_completo]);
                        } else {
                            $_SESSION["error_message"] =
                                "Erro ao fazer upload da imagem: " . $file_name;
                            header("Location: index.php");
                            exit();
                        }
                    }
                }
            } else {
                if ($_FILES["imagens"]["error"] === UPLOAD_ERR_OK) {
                    $file_name = $_FILES["imagens"]["name"];
                    $file_tmp = $_FILES["imagens"]["tmp_name"];

                    $file_ext = strtolower(
                        pathinfo($file_name, PATHINFO_EXTENSION),
                    );
                    $novo_nome_arquivo =
                        uniqid("anuncio_" . $id_anuncio . "_", true) .
                        "." .
                        $file_ext;
                    $caminho_completo = $upload_dir . $novo_nome_arquivo;

                    if (move_uploaded_file($file_tmp, $caminho_completo)) {
                        $stmt_i->execute([$id_anuncio, $caminho_completo]);
                    } else {
                        $_SESSION["error_message"] =
                            "Erro ao fazer upload da imagem: " . $file_name;
                        header("Location: index.php");
                        exit();
                    }
                }
            }
        }

        $pdo->commit();
        $_SESSION["success_message"] = "Anúncio cadastrado com sucesso!";
        header("Location: anunciante_painel.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION["error_message"] =
            "Erro ao cadastrar o anúncio: " . $e->getMessage();
        header("Location: anunciante_painel.php");
        exit();
    }
}

?>
