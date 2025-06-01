<?= formTitulo("UF") ?>

<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>" enctype="multipart/form-data">

        <input type="hidden" name="id" id="id" value="<?= setValor("id") ?>">

        <div class="row">
            <div class="col-2 mb-3">
                <label for="sigla" class="form-label">Sigla</label>
                <input type="text" class="form-control" 
                    id="sigla" 
                    name="sigla" 
                    placeholder="Sigla UF"
                    maxlength="2"
                    value="<?= setValor("sigla") ?>"
                    required
                    autofocus>
                <?= setMsgFilderError("sigla") ?>
            </div>

            <div class="col-10 mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" 
                    id="descricao" 
                    name="descricao" 
                    placeholder="Descrição da UF"
                    maxlength="50"
                    value="<?= setValor("descricao") ?>"
                    required>
                <?= setMsgFilderError("descricao") ?>
            </div>
        </div>

        <div class="row">
            <?php if (in_array($this->request->getAction(), ['insert', 'update'])): ?>
                <div class="mb-3 col-12">
                    <label for="bandeira" class="form-label">Imagem da Bandeira da UF</label>
                    <input type="file" class="form-control" id="bandeira" name="bandeira" placeholder="Anexar a Imagem da Bandeira da UF" maxlength="100" value="<?= setValor('bandeira') ?>">
                    <?= setMsgFilderError('bandeira') ?>
                </div>
            <?php endif; ?>

            <?php if (trim(setValor("bandeira")) != ""): ?>
                <div class="mb-3 col-12">
                    <h5>Imagem</h5>
                    <img src="<?= baseUrl() . 'imagem.php?file=uf/' . setValor("bandeira") ?>" class="img-thumbnail" height="120" width="240" alt="Imagem Bandeira UF">
                    <input type="hidden" name="nomeImagem" id="nomeImagem" value="<?= setValor("bandeira") ?>">
                </div>
            <?php endif; ?>
        </div>

        <?= formButton() ?>

    </form>

</div>