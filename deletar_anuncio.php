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
            $sql_s = "SELECT * FROM Imagens WHERE id_anuncio = ?";
            $stmt_s = $pdo->prepare($sql_s);
            $stmt_s->execute([$_POST["id_anuncio"]]);

            $imagens = $stmt_s->fetchAll(PDO::FETCH_ASSOC);
            var_dump($imagens);
            foreach ($imagens as $imagem) {
                unlink($imagem["imagem_caminho"]);
            }

            $sql_i = "DELETE FROM Imagens WHERE id_anuncio = ?";
            $stmt_i = $pdo->prepare($sql_i);
            $stmt_i->execute([$_POST["id_anuncio"]]);

            $sql_d = "DELETE FROM Anuncio WHERE id_anuncio = ?";
            $stmt_d = $pdo->prepare($sql_d);
            $stmt_d->execute([$_POST["id_anuncio"]]);

            $_SESSION["success_message"] = "Anúncio deletado com sucesso!";
            header("Location: anunciante_painel.php");
            exit();
        }
    }
}

$_SESSION["error_message"] =
    "Anúncio não encontrado ou não pertence ao anunciante.";
header("Location: anunciante_painel.php");
exit();

?>
