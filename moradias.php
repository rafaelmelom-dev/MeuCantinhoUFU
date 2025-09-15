<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meu Cantinho UFU - Moradias</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
        crossorigin="anonymous" />

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        /* reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* container settings */
        .container-title {
            padding: 40px 0px 40px 150px;
            color: #333;
        }
    </style>
    <script>
        $(document).ready(function() {
                $("#modal-placeholder").load(
                    "saibamais.html",
                    function(response, status, xhr) {
                        if (status == "error") {
                            console.error(
                                "Erro ao carregar o modal saibamais.html:",
                                xhr.status + " " + xhr.statusText
                            );
                        }
                    }
                );

                $(document).on("click", ".card-button", function() {
                    var saibaMaisModal = new bootstrap.Modal(
                        document.getElementById("saibaMaisModal")
                    );
                    saibaMaisModal.show();
                });
            });
        });
    </script>
</head>

<body>
    <div id="modal-placeholder"></div>
    <header>
        <?php include "header.php"; ?>
    </header>

    <div class="container-sm my-3">
        <h1 class="py-5 fw-bold">Moradias</h1>
        <div
            id="cards-container"
            class="row row-cols-1 row-cols-md-3 g-4 mb-4">

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
                        ORDER BY
                            a.id_anuncio DESC';

                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $anuncios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($anuncios as $anuncio) {
                    include "card.php";
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
