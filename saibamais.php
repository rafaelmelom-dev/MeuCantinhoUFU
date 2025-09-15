    <?php
    // Query para buscar todas as imagens do anúncio
    $sql_images = "SELECT imagem_caminho FROM Imagens WHERE id_anuncio = ?";
    $stmt_images = $pdo->prepare($sql_images);
    $stmt_images->execute([$anuncio["id_anuncio"]]);
    $images = $stmt_images->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saibaMaisModalLabel">
                    Detalhes da Moradia
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar"
                ></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?php if (!empty($images)): ?>
                            <div id="carousel<?php echo htmlspecialchars(
                                $anuncio["id_anuncio"],
                            ); ?>" class="carousel slide mb-3" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <?php foreach (
                                        $images
                                        as $key => $image
                                    ): ?>
                                        <button type="button"
                                                data-bs-target="#carousel<?php echo htmlspecialchars(
                                                    $anuncio["id_anuncio"],
                                                ); ?>"
                                                data-bs-slide-to="<?php echo $key; ?>"
                                                <?php echo $key === 0
                                                    ? 'class="active" aria-current="true"'
                                                    : ""; ?>
                                                aria-label="Slide <?php echo $key +
                                                    1; ?>"></button>
                                    <?php endforeach; ?>
                                </div>
                                <div class="carousel-inner" style="border-radius: 6px;">
                                    <?php foreach (
                                        $images
                                        as $key => $image
                                    ): ?>
                                        <div class="carousel-item <?php echo $key ===
                                        0
                                            ? "active"
                                            : ""; ?>">
                                            <img src="<?php echo htmlspecialchars(
                                                $image["imagem_caminho"],
                                            ); ?>"
                                                 class="d-block w-100"
                                                 alt="Imagem do imóvel <?php echo $key +
                                                     1; ?>"
                                                 style="height: 300px; object-fit: cover; border-radius: 6px;">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (count($images) > 1): ?>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo htmlspecialchars(
                                        $anuncio["id_anuncio"],
                                    ); ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Anterior</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo htmlspecialchars(
                                        $anuncio["id_anuncio"],
                                    ); ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Próximo</span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="height: 300px; border-radius: 6px">
                                <span class="text-muted">Sem imagens disponíveis</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <form action="anunciante.php" method="post" id="tituloAnunciante">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars(
                                    $anuncio["id_anunciante"],
                                ); ?>">
                                <a href="javascript:;" onclick="this.parentNode.submit()" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center p-3 border-bottom">
                                        <img src="<?php echo htmlspecialchars(
                                            $anuncio["foto_caminho"],
                                        ); ?>" alt="Foto do Anunciante" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        <b><?php echo htmlspecialchars(
                                            $anuncio["nome"],
                                        ); ?></b>
                                    </div>
                                </a>
                            </form>
                        </div>

                        <ul class="list-group list-group-flush mb-3">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                <strong>Valor:</strong>
                                <span
                                    >R$
                                        <span id="detail-valor"><?php echo htmlspecialchars(
                                            $anuncio["valor"],
                                        ); ?></span></span
                                >
                            </li>
                            <li class="list-group-item">
                                <strong>Endereço:</strong>
                                <p class="mb-0">
                                    <span id="detail-rua"><?php echo htmlspecialchars(
                                        $anuncio["rua"],
                                    ); ?></span>,
                                    <span id="detail-numero"><?php echo htmlspecialchars(
                                        $anuncio["numero"],
                                    ); ?></span> -
                                    <span id="detail-bairro"><?php echo htmlspecialchars(
                                        $anuncio["bairro"],
                                    ); ?></span>
                                </p>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center"
                            >
                                <strong>Tipo de Residência:</strong>
                                <span id="detail-tipo-residencia"><?php echo htmlspecialchars(
                                    $anuncio["tipo_residencia"],
                                ); ?></span>
                            </li>
                        </ul>
                        <strong>Descrição:</strong>
                        <p id="detail-descricao">
                        <?php echo htmlspecialchars($anuncio["descricao"]); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-primary"
                    id="anunciante-contato"
                    onclick="window.open('https://wa.me/55<?php echo htmlspecialchars(
                        $anuncio["telefone"],
                    ); ?>', '_blank');">
                    Entrar em Contato
                </button>
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
            </div>
        </div>
    </div>
