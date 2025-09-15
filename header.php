<?php
include "config.php";

if (isset($_SESSION["success_message"])) {
    echo '<div class="alert alert-success">' .
        $_SESSION["success_message"] .
        "</div>";
    unset($_SESSION["success_message"]);
}
if (isset($_SESSION["error_message"])) {
    echo '<div class="alert alert-danger">' .
        $_SESSION["error_message"] .
        "</div>";
    unset($_SESSION["error_message"]);
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand px-3" href="index.php"><h2>Meu Cantinho UFU</h2></a>
    <button
        class="navbar-toggler me-3"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Inícios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="moradias.php">Moradias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manual.php">Manual do Calouro</a>
            </li>
            <?php
            include "config.php";
            if (isset($_SESSION["id_anunciante"])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="anunciante_painel.php">Painel Anunciante</a>
                </li>
            <?php endif;
            ?>
        </ul>
        <?php
        include "config.php";
        if (isset($_SESSION["id_anunciante"])): ?>
            <span class="navbar-text mx-3">
                Olá, <?php echo htmlspecialchars($_SESSION["nome"]); ?>!
            </span>
            <img src="<?php echo htmlspecialchars(
                $_SESSION["foto_perfil"],
            ); ?>" alt="Foto de Perfil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
            <a href="logout.php" class="btn btn-danger mx-2 me-3">Sair</a>

        <?php else: ?>
            <button
                class="btn btn-secondary mx-1"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#loginModal"
            >
                Entrar
            </button>
            <button
                class="btn btn-primary mx-1 me-3"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#registroModal"
            >
                Cadastrar
            </button>
        <?php endif;
        ?>
    </div>
</nav>

<div id="loginModalPlaceholder"></div>
<div id="registroModalPlaceholder"></div>

<script>
    $("nav a").hover(
        function () {
            $(this).addClass("link-primary link-underline-opacity-0");
        },
        function () {
            $(this).removeClass("link-primary link-underline-opacity-0");
        }
    );

    $("#navbarNav").on("show.bs.collapse", function () {
        $("#navbarNav li").addClass("px-3");
        $("#navbarNav button:first").addClass("ms-3");
        $("#navbarNav button:first").removeClass("ms-auto");
    });

    $("#navbarNav").on("hidden.bs.collapse", function () {
        $("#navbarNav li").removeClass("px-3");
        $("#navbarNav button:first").removeClass("ms-3");
        $("#navbarNav button:first").addClass("ms-auto");
    });

    $(document).ready(function () {
        $("#loginModalPlaceholder").load(
            "login_modal.html",
            function (response, status, xhr) {
                if (status == "error") {
                    console.error(
                        "Erro ao carregar o modal de Login:",
                        xhr.status + " " + xhr.statusText
                    );
                }
            }
        );

        $("#registroModalPlaceholder").load(
            "registro_modal.html",
            function (response, status, xhr) {
                if (status == "error") {
                    console.error(
                        "Erro ao carregar o modal de Cadastro:",
                        xhr.status + " " + xhr.statusText
                    );
                }
            }
        );
    });
</script>
