<script type="text/javascript" src="<?= baseUrl(); ?>assets/js/usuario.js"></script>

<?= formTitulo('Usuário') ?>

<form method="POST" action="<?= $this->request->formAction() ?>">

    <input type="hidden" name="id" id="id" value="<?= setValor('id') ?>">

    <div class="row m-2">

        <div class="mb-3 col-8">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Usuário" maxlength="60" value="<?= setValor('nome') ?>" required autofocus>
            <?= setMsgFilderError('nome') ?>
        </div>

        <div class="mb-3 col-4">
            <label for="nivel" class="form-label">Nível</label>
            <select class="form-select" name="nivel" id="nivel" aria-label="Large select nivel" required>
                <option value="0"  <?= (setValor('nivel') == ""   ? 'selected': "") ?>>...</option>
                <option value="1"  <?= (setValor('nivel') == "1"  ? 'selected': "") ?>>Super Administrador</option>
                <option value="11" <?= (setValor('nivel') == "11" ? 'selected': "") ?>>Administrador</option>
                <option value="21" <?= (setValor('nivel') == "21" ? 'selected': "") ?>>Usuário</option>
            </select>
            <?= setMsgFilderError('tipo') ?>
        </div>

        <div class="mb-3 col-8">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email do Usuário" maxlength="150" value="<?= setValor('email') ?>" required>
            <?= setMsgFilderError('email') ?>
        </div>

        <div class="mb-3 col-4">
            <label for="statusRegistro" class="form-label">Status</label>
            <select class="form-select" name="statusRegistro" id="statusRegistro" aria-label="Large select statusRegistro" required>
                <option value="0" <?= (setValor('statusRegistro') == ""  ? 'selected': "") ?>>...</option>
                <option value="1" <?= (setValor('statusRegistro') == "1" ? 'selected': "") ?>>Ativo</option>
                <option value="2" <?= (setValor('statusRegistro') == "2" ? 'selected': "") ?>>Inativo</option>
            </select>
            <?= setMsgFilderError('statusRegistro') ?>
        </div>

        <?php if (in_array($this->request->getAction(), ['insert', 'update'])): ?>

            <div class="mb-3 col-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" 
                    placeholder="Informe uma senha" maxlength="60"
                    onkeyup="checa_segur_senha('senha', 'msgSenha', 'btEnviar');"
                    <?= ($this->request->getAction() == "insert" ? 'required' : '') ?>>
                <div id="msgSenha" class="mt-3"></div>
                <?= setMsgFilderError('senha') ?>
            </div>

            <div class="mb-3 col-6">
                <label for="confSenha" class="form-label">Confirma a Senha</label>
                <input type="password" class="form-control" id="confSenha" name="confSenha" 
                    placeholder="Digite a senha para conferência" maxlength="60" 
                    onkeyup="checa_segur_senha('confSenha', 'msgConfSenha', 'btEnviar');"
                    <?= ($this->request->getAction() == "insert" ? 'required' : '') ?>>
                <div id="msgConfSenha" class="mt-3"></div>
                <?= setMsgFilderError('confSenha') ?>
            </div>
        <?php endif; ?>

    </div>

    <div class="m-3">
        <?= formButton() ?>
    </div>

</form>
