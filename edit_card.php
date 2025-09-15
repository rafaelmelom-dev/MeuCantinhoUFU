<style>
    .container {
        padding-top: 50px;
    }

    .form-label {
        font-weight: 500;
    }
</style>

<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="anuncioModalLabel">Editar Anúncio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="anuncioFormEdit" method="POST" enctype="multipart/form-data" action="atualizar_anuncio.php">
                <input type="hidden" id="id_anuncio" name="id_anuncio" value="<?php echo htmlspecialchars(
                                                                                    $anuncio["id_anuncio"],
                                                                                ); ?>">

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Ex: Apartamento aconchegante com 2 quartos..." required><?php echo htmlspecialchars(
                                                                                                                                                                        $anuncio["descricao"],
                                                                                                                                                                    ); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="valor" class="form-label">Valor (R$)</label>
                        <input type="number" class="form-control" id="valor" name="valor" placeholder="Ex: 1500" required value="<?php echo htmlspecialchars(
                                                                                                                                        $anuncio["valor"],
                                                                                                                                    ); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tipo_residencia" class="form-label">Tipo de Residência</label>
                        <select class="form-select" id="tipo_residencia" name="tipo_residencia" required>
                            <option disabled value="">Selecione...</option>
                            <option <?php if (
                                        $anuncio["tipo_residencia"] == "Casa"
                                    ) {
                                        echo "selected";
                                    } ?> value="Casa">Casa</option>
                            <option <?php if (
                                        $anuncio["tipo_residencia"] == "Kitnet"
                                    ) {
                                        echo "selected";
                                    } ?> value="Kitnet">Kitnet</option>
                            <option <?php if (
                                        $anuncio["tipo_residencia"] == "Apartamento"
                                    ) {
                                        echo "selected";
                                    } ?> value="Apartamento">Apartamento</option>
                            <option <?php if (
                                        $anuncio["tipo_residencia"] == "Rural"
                                    ) {
                                        echo "selected";
                                    } ?> value="Rural">Rural</option>
                        </select>
                    </div>
                </div>

                <h6 class="mt-3">Endereço</h6>
                <hr class="mt-0">

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" placeholder="Ex: Av. Brasil" required value="<?php echo $anuncio["rua"]; ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="number" class="form-control" id="numero" name="numero" placeholder="Ex: 123" required value="<?php echo $anuncio["numero"]; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Ex: Centro" required value="<?php echo $anuncio["bairro"]; ?>">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" id="salvarBtn">Salvar Alterações</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const form = $("#anuncioFormEdit");
        const bt = $("#salvarBtn");

        bt.click(function() {
            form.submit();
        });
    })
</script>
