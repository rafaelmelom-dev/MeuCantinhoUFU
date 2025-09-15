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
            $sql_u =
                "UPDATE Anuncio SET rua = ?, numero = ?, bairro = ?, valor = ?, descricao = ?, tipo_residencia = ? WHERE id_anuncio = ?";
            $stmt_u = $pdo->prepare($sql_u);
            $stmt_u->execute([
                htmlspecialchars($_POST["rua"]),
                htmlspecialchars($_POST["numero"]),
                htmlspecialchars($_POST["bairro"]),
                htmlspecialchars($_POST["valor"]),
                htmlspecialchars($_POST["descricao"]),
                htmlspecialchars($_POST["tipo_residencia"]),
                htmlspecialchars($_POST["id_anuncio"]),
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

?>
