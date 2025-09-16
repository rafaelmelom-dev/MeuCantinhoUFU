<div>
    <div
        class="modal fade"
        id="editModal<?php echo htmlspecialchars($anuncio["id_anuncio"]); ?>"
        tabindex="-1"
        aria-labelledby="anuncioModalLabel"
        aria-hidden="true">

        <?php include "edit_card.php"; ?>
    </div>
    <div
        class="modal fade"
        id="deleteModal<?php echo htmlspecialchars($anuncio["id_anuncio"]); ?>"
        tabindex="-1"
        aria-labelledby="anuncioModalLabel"
        aria-hidden="true">
        <?php include "delete_card.php"; ?>
    </div>
    <div class="card mb-4 shadow-sm">
        <div
            class="card-img-top bg-light d-flex align-items-center justify-content-center"
            style="height: 250px">
            <?php if (!empty($anuncio["imagem_caminho"])): ?>
                <img src="<?php echo htmlspecialchars(
                                $anuncio["imagem_caminho"],
                            ); ?>" class="card-img-top" alt="Imagem do imóvel" style="height: 250px; object-fit: cover;">
            <?php else: ?>
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px">
                    <span class="text-muted">Sem imagem</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title fw-bold">R$ <?php echo htmlspecialchars(
                                                    $anuncio["valor"],
                                                ); ?></h5>
            <p class="card-text text-secondary"><?php echo htmlspecialchars(
                                                    $anuncio["descricao"],
                                                ); ?></p>

            <button class="card-button btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo htmlspecialchars(
                                                                                                                $anuncio["id_anuncio"],
                                                                                                            ); ?>">Editar</button>
            <button class="card-button btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo htmlspecialchars(
                                                                                                                $anuncio["id_anuncio"],
                                                                                                            ); ?>">Excluir</button>
        </div>
    </div>
</div>
