<?= formTitulo("Cidade") ?>

<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>">

        <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">

        <div class="row">
            <div class="col-12 mb-3">
                <label for="sigla" class="form-label">Nome</label>
                <input type="text" class="form-control" 
                    id="nome" 
                    name="nome" 
                    placeholder="Nome da Cidade"
                    maxlength="50"
                    value="<?= setValor("nome") ?>"
                    required
                    autofocus>
                <?= setMsgFilderError("nome") ?>
            </div>

        </div>
        <div class="row">

            <div class="col-9 mb-3">
                <label for="uf_id" class="form-label">UF</label>
                <select class="form-control" 
                    id="uf_id" 
                    name="uf_id" 
                    required>
                    <option value="">...</option>
                    <?php foreach ($dados['aUf'] as $value): ?>
                        <option value="<?= $value['id'] ?>" <?= ($value['id'] == setValor("uf_id") ? 'SELECTED' : '') ?>><?= $value['sigla']  . ' - '. $value['descricao'] ?></option>
                    <?php endforeach; ?>
                </select>
                <?= setMsgFilderError("uf_id") ?>
            </div>

            <div class="col-3 mb-3">
                <label for="codIBGE" class="form-label">Código do IBGE</label>
                <input type="text" class="form-control" 
                    id="codIBGE" 
                    name="codIBGE" 
                    placeholder="Código do IBGGE"
                    maxlength="7"
                    value="<?= setValor("codIBGE") ?>"
                    required>
                <?= setMsgFilderError("codIBGE") ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <label for="codIBGE" class="form-label">Wiki sobre a cidade</label>
                <textarea class="form-control" id="wiki" name="wiki"><?= setValor("wiki") ?></textarea>
                <?= setMsgFilderError("wiki") ?>
            </div>
        </div>
        
        <?= formButton() ?>

    </form>

</div>

<script src="<?= baseUrl() ?>assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>

<script type="text/javascript">

    ClassicEditor
        .create(document.querySelector('#wiki'))
        .catch( error => {
            console.error(error);
        });

</script>