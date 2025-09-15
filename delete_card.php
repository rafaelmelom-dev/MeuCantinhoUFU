<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Remover anúncio</h5>
        </div>
        <div class="modal-body">
            Você tem certeza que quer excluir esse anúncio?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form action="deletar_anuncio.php" method="POST">
                <input type="hidden" name="id_anuncio" value="<?php echo $anuncio[
                    "id_anuncio"
                ]; ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
