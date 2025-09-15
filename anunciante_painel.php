<?php

include "config.php";

if (!isset($_SESSION["id_anunciante"])) {
    $_SESSION["error_message"] = "Usuário não logado para acessar essa página";
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Meu Cantinho UFU - Painel do Anunciante</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <style>
            /* reset */
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                line-height: 1.6;
                color: #333;
            }
        </style>
        <script>
            $(document).ready(function () {
                $("#manipula-card").load("manipula_card_anunciante.html");
            });
        </script>
    </head>
    <body>
        <div id="addModal">
            <?php include "add_card.php"; ?>
        </div>
        <header>
            <?php include "header.php"; ?>
        </header>

        <div class="container-sm my-3">
            <div class="d-flex justify-content-between py-5">
                <h1 class="fw-bold">Anúncios</h1>
                <button class="btn btn-primary float-end fw-bold" data-bs-toggle="modal" data-bs-target="#anuncioModalAdd")">Adicionar anúncio</button>
            </div>
            <div
                id="cards-container"
                class="row row-cols-1 row-cols-md-3 g-4 mb-4"
            >

                <?php
                include "db.php";

                $sql = 'SELECT
                    a.*,
                    an.nome,
                    an.foto_caminho,
                    (SELECT i.imagem_caminho FROM Imagens i WHERE i.id_anuncio = a.id_anuncio LIMIT 1) as imagem_caminho
                FROM
                    Anuncio AS a
                JOIN
                    Anunciante AS an ON a.id_anunciante = an.id_anunciante
                WHERE a.id_anunciante = ?
                ORDER BY
                    a.id_anuncio DESC';

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_SESSION["id_anunciante"]]);
                $anuncios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($anuncios as $anuncio) {
                    include "card_anunciante.php";
                }

                if (!$anuncios) {
                    echo '<div class="col">';
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Nenhum anúncio encontrado</h5>';
                    echo '<p class="card-text">Não há anúncios disponíveis no momento.</p>';
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </body>
</html>
