<style>
    .container {
        padding-top: 50px;
    }

    .image-preview-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        margin-bottom: 0.5rem;
        background-color: #fff;
    }

    .image-preview-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 0.25rem;
        margin-right: 1rem;
    }

    .image-preview-item span {
        flex-grow: 1;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .form-label {
        font-weight: 500;
    }
</style>

<div class="modal fade" id="anuncioModalAdd" tabindex="-1" aria-labelledby="anuncioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="anuncioModalLabel">Adicionar Novo Anúncio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="anuncioFormAdd" action="inserir_anuncio.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Ex: Apartamento aconchegante com 2 quartos..." required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="valor" class="form-label">Valor (R$)</label>
                            <input type="number" class="form-control" id="valor" name="valor" placeholder="Ex: 1500" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tipo_residencia" class="form-label">Tipo de Residência</label>
                            <select class="form-select" id="tipo_residencia" name="tipo_residencia" required>
                                <option selected disabled value="">Selecione...</option>
                                <option value="Casa">Casa</option>
                                <option value="Kitnet">Kitnet</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Rural">Rural</option>
                            </select>
                        </div>
                    </div>

                    <h6 class="mt-3">Endereço</h6>
                    <hr class="mt-0">

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="rua" class="form-label">Rua</label>
                            <input type="text" class="form-control" id="rua" name="rua" placeholder="Ex: Av. Brasil" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="numero" class="form-label">Número</label>
                            <input type="number" class="form-control" id="numero" name="numero" placeholder="Ex: 123" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Ex: Centro" required>
                    </div>

                    <h6 class="mt-3">Imagens</h6>
                    <hr class="mt-0">

                    <input type="file" id="image-upload" name="imagens[]" multiple accept="image/*" class="d-none">

                    <div id="image-preview-container" class="mb-3"></div>
                    <button type="button" class="btn btn-outline-primary" id="add-image-button">
                        <i class="bi bi-file-earmark-arrow-up-fill me-2"></i> Adicionar Imagem
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" id="cadastroBotao" class="btn btn-primary">Cadastrar Anúncio</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const addImageButton = document.getElementById('add-image-button');
        const imageUploadInput = document.getElementById('image-upload');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const form = document.getElementById("anuncioFormAdd");
        const submitButton = document.getElementById("cadastroBotao");

        let selectedFiles = [];

        addImageButton.addEventListener('click', () => {
            imageUploadInput.click();
        });

        imageUploadInput.addEventListener('change', (event) => {
            const files = event.target.files;
            if (files) {
                for (const file of files) {
                    selectedFiles.push(file);
                    createImagePreview(file);
                }
            }
            event.target.value = '';
        });

        function createImagePreview(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewItem = document.createElement('div');
                previewItem.className = 'image-preview-item';

                const img = document.createElement('img');
                img.src = e.target.result;

                const fileName = document.createElement('span');
                fileName.textContent = file.name;

                const removeBtn = document.createElement('button');
                removeBtn.className = 'btn btn-sm btn-danger';
                removeBtn.innerHTML = '<i class="bi bi-trash-fill"></i>';
                removeBtn.type = 'button';

                removeBtn.addEventListener('click', () => {
                    const index = selectedFiles.indexOf(file);
                    if (index > -1) {
                        selectedFiles.splice(index, 1);
                    }
                    previewItem.remove();
                });

                previewItem.appendChild(img);
                previewItem.appendChild(fileName);
                previewItem.appendChild(removeBtn);
                imagePreviewContainer.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        }

        submitButton.addEventListener('click', () => {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            imageUploadInput.files = dataTransfer.files;

            form.submit();
        });
    })
</script>
