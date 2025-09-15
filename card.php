<div>
<div
    class="modal fade"
    id="modal<?php echo htmlspecialchars($anuncio["id_anuncio"]); ?>"
    tabindex="-1"
    aria-labelledby="saibaMaisModalLabel"
    aria-hidden="true"
>
    <?php include "saibamais.php"; ?>
</div>
<div class="card mb-4 shadow-sm">
    <form action="anunciante.php" method="post" id="tituloAnunciante">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars(
            $anuncio["id_anunciante"],
        ); ?>">
        <a href="javascript:;" onclick="this.parentNode.submit()" class="text-decoration-none text-dark">
            <div class="d-flex align-items-center p-3 border-bottom">
                <img src="<?php echo htmlspecialchars(
                    $anuncio["foto_caminho"],
                ); ?>" alt="Foto do Anunciante" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                <b><?php echo htmlspecialchars($anuncio["nome"]); ?></b>
            </div>
        </a>
    </form>
    <?php if (!empty($anuncio["imagem_caminho"])): ?>
        <img src="<?php echo htmlspecialchars(
            $anuncio["imagem_caminho"],
        ); ?>" class="card-img-top rounded-0" alt="Imagem do imóvel" style="height: 250px; object-fit: cover;">
    <?php else: ?>
        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px">
            <span class="text-muted">Sem imagem</span>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-text mb-0">R$ <?php echo htmlspecialchars(
                $anuncio["valor"],
            ); ?></h5>
        </div>
        <button
            type="button"
            class="card-button btn btn-primary w-100"
            data-bs-toggle="modal"
            data-bs-target="#modal<?php echo htmlspecialchars(
                $anuncio["id_anuncio"],
            ); ?>"
        >
            Saber mais
        </button>
    </div>
</div>
</div>
