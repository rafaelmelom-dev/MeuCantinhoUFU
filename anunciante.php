<?php
include "config.php";
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql =
        "SELECT nome, foto_caminho, descricao, telefone FROM Anunciante WHERE id_anunciante = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        $_SESSION["error_message"] = "Usuário não existe";
        header("Location: index.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meu Cantinho UFU - Perfil do Anunciante</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-header {
            background-color: #fff;
            padding: 40px 0;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 30px;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-button {
            height: fit-content;
        }
    </style>
    <script>
        // $(document).ready(function () {
        //     $("header").load("header.html");
        // });
    </script>
</head>

<body>
    <header>
        <?php include "header.php"; ?>
    </header>

    <main class="container my-5">
        <section class="profile-header text-center text-md-start px-5">
            <div class="container">
                <div class="row align-items-center">
                    <div
                        class="col-md-3 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
                        <img
                            src="<?php echo $usuario["foto_caminho"]; ?>"
                            alt="Foto do Anunciante"
                            class="profile-image" />
                    </div>
                    <div
                        class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <h2 class="mb-2" id="anunciante-nome">
                            <?php echo $usuario["nome"]; ?>
                        </h2>
                        <p class="text-muted" id="anunciante-descricao">
                            <?php echo $usuario["descricao"]; ?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 d-flex justify-content-center justify-content-md-end">
                        <button
                            class="btn btn-primary btn-lg contact-button"
                            id="anunciante-contato"
                            onclick="window.open('https://wa.me/55<?php echo htmlspecialchars(
                                $usuario["telefone"],
                            ); ?>', '_blank');">
                            Entrar em Contato
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="anuncios-do-anunciante">
            <h3 class="mb-4 text-center text-md-start">
                Anúncios de
                <span id="anuncios-anunciante-nome">Nome do Anunciante</span>
            </h3>
            <div
                id="anuncios-container"
                class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                    <?php
                    include "db.php";

                    $sql = 'SELECT
                                a.*,
                                an.nome,
                                an.telefone,
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
                    $stmt->execute([$id]);
                    $anuncios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($anuncios as $anuncio) {
                        include "card.php";
                    }
                    ?>
            </div>
        </section>
    </main>

    <div id="modal-placeholder"></div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
