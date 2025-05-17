<?= formTitulo("UF") ?>

<div class="m-2">

    <form method="POST" action="<?= $this->request->formAction() ?>">

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

        <?= formButton() ?>

    </form>

</div>