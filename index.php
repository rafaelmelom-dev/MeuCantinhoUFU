<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Meu Cantinho UFU</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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

        <section class="container text-center py-5 mb-5">
            <h1 class="pt-3"><b>Bem-vindo ao Meu Cantinho UFU</b></h1>
            <p class="pb-3">
                Encontrar um lugar para chamar de seu e se adaptar à vida
                universitária ficou mais fácil.
            </p>
            <a href="moradias.php" class="btn btn-primary p-3 fw-bold"
                >ENCONTRAR MEU CANTINHO</a
            >
        </section>

        <section class="container-sm">
            <div class="row">
                <div class="col my-3">
                    <div class="card m-auto" style="width: 18rem; height: 100%">
                        <div class="card-body">
                            <h4 class="card-title text-center">
                                <b>Mural de Anúncios</b>
                            </h4>
                            <p class="card-text text-center">
                                Explore nosso mural com dezenas de opções de
                                moradias, apartamentos e repúblicas para
                                encontrar o ideal para você.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col my-3">
                    <div class="card m-auto" style="width: 18rem; height: 100%">
                        <div class="card-body">
                            <h4 class="card-title text-center">
                                <b>Mapa Interativo</b>
                            </h4>
                            <p class="card-text text-center">
                                Veja a localização exata de cada "cantinho" e a
                                sua distância do campus da UFU em Monte Carmelo.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col my-3">
                    <div class="card m-auto" style="width: 18rem; height: 100%">
                        <div class="card-body">
                            <h4 class="card-title text-center">
                                <b>Manual do Calouro</b>
                            </h4>
                            <p class="card-text text-center">
                                Se você é novo por aqui, confira nosso manual
                                com dicas essenciais para começar sua jornada na
                                UFU com o pé direito.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container text-center p-5 mt-5">
            <h2 class="fs-2">Sinta-se em casa antes mesmo de encontrar uma!</h2>
        </section>
    </body>
</html>
