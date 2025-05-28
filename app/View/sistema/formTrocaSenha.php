<?php

    use Core\Library\Session;
?>

<script type="text/javascript" src="<?= baseUrl(); ?>assets/js/usuario.js"></script>

<div class="row bg-primary text-white m-2">
    <div class="col-10 p-2">
        <h3>Trocar a Senha</h3>
    </div>
    <div class="col-2 text-end p-2">
        <a href="<?=  baseUrl() ?>" title="Voltar" class="btn btn-outline-info text-white">Voltar</a>
    </div>
</div>

<?= exibeAlerta() ?>

<form method="POST" action="<?= baseUrl() ?>Usuario/updateNovaSenha">

    <input type="hidden" name="id" id="id" value="<?= Session::get("userId") ?>">

    <div class="container mt-5">

        <div class="mb-3 input-group">
            <label class="ml-1 fs-3">Usuário: <b><?= Session::get('userNome') ?></b></label>
        </div>

        <div class="mb-3 control-group">
            <span class="input-group-addon"><i class="fa fa-key"></i> Senha Atual</span>
            <div class="controls mt-2">
                <input name="senhaAtual" id="senhaAtual" type="password" class="form-control" required="required">
            </div>
        </div>

        <div class="mb-3 control-group">
            <span class="input-group-addon"><i class="fa fa-key"></i> Nova Senha</span>
            <div class="controls mt-2">
                <input name="novaSenha" id="novaSenha" type="password" class="form-control" required="required"
                        onkeyup="checa_segur_senha( 'novaSenha', 'msgSenhaNova', 'btEnviar' );">
                <div id="msgSenhaNova" class="mt-3"></div>
            </div>
        </div>

        <div class="mb-3 control-group">
            <span class="input-group-addon"><i class="fa fa-key"></i> Confirme a nova senha</span>
            <div class="controls mt-2">
                <input name="novaSenha2" id="novaSenha2" type="password" class="form-control" placeholder="Nova senha" required="required"
                        onkeyup="checa_segur_senha( 'novaSenha2', 'msgSenhaNova2', 'btEnviar' );">
                <div id="msgSenhaNova2" class="mt-3"></div>
            </div>
        </div>

        <div class="mt-5 form-group">
            <!-- Button -->
            <div class="col-xs-2 controls">
                <button class="btn btn-primary" id="btEnviar" disabled>Atualizar</button>
            </div>
        </div>
    </div>

</form>

