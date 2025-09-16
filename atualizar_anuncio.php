<?php

include "db.php";
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["id_anunciante"])) {
        $sql = "SELECT * FROM Anuncio WHERE id_anuncio = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST["id_anuncio"]]);
        $anuncio = $stmt->fetch();

        if (
            $anuncio &&
            $anuncio["id_anunciante"] == $_SESSION["id_anunciante"]
        ) {

            $id = $_SESSION["id_anunciante"];
            $desc = htmlspecialchars(trim($_POST["descricao"]));
            $valor = htmlspecialchars(trim($_POST["valor"]));
            $tipo = htmlspecialchars(trim($_POST["tipo_residencia"]));
            $rua = htmlspecialchars(trim($_POST["rua"]));
            $num = htmlspecialchars(trim($_POST["numero"]));
            $bairro = htmlspecialchars(trim($_POST["bairro"]));

            if (!isset($rua) || $rua === '') {
                $_SESSION['error_message'] = 'Algum campo ficou vazio';
                header("Location: anunciante_painel.php");
                exit();
            }

            if (!isset($num) || $num === '') {
                $_SESSION['error_message'] = 'Algum campo ficou vazio';
                header("Location: anunciante_painel.php");
                exit();
            }

            if (!isset($bairro) || $bairro === '') {
                $_SESSION['error_message'] = 'Algum campo ficou vazio';
                header("Location: anunciante_painel.php");
                exit();
            }

            if (!isset($valor) || $valor === '') {
                $_SESSION['error_message'] = 'Algum campo ficou vazio';
                header("Location: anunciante_painel.php");
                exit();
            }

            $valor = filter_var($valor, FILTER_VALIDATE_INT);
            $num = filter_var($num, FILTER_VALIDATE_INT);

            if ($valor === false || $valor < 0) {
                $_SESSION['error_message'] = 'Valor incorreto';
                header("Location: anunciante_painel.php");
                exit();
            }


            if ($num === false || $num < 0) {
                $_SESSION['error_message'] = 'Valor incorreto';
                header("Location: anunciante_painel.php");
                exit();
            }

            $sql_u =
                "UPDATE Anuncio SET rua = ?, numero = ?, bairro = ?, valor = ?, descricao = ?, tipo_residencia = ? WHERE id_anuncio = ?";
            $stmt_u = $pdo->prepare($sql_u);
            $stmt_u->execute([
                $rua,
                $num,
                $bairro,
                $valor,
                $desc,
                $tipo,
                $id
            ]);

            $_SESSION["success_message"] = "Anúncio modificado com sucesso!";
            header("Location: anunciante_painel.php");
            exit();
        }
    }
}

$_SESSION["error_message"] = "Anúncio pode não pertencer ao anunciante.";
header("Location: anunciante_painel.php");
exit();
