<?= formTitulo("Lista Cidade", true) ?>

<?php if (count($dados) > 0): ?>

    <div class="m-2">

        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">UF</th>
                    <th scope="col">Código IBGE</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $value): ?>
                    <tr>
                        <th scope="row"><?= $value['id'] ?></th>
                        <td><?= $value['nome'] ?></td>
                        <td><?= $value['sigla'] ?></td>
                        <td><?= $value['codIBGE'] ?></td>                    
                        <td>
                            <a href="<?= baseUrl() ?>Cidade/form/view/<?= $value['id'] ?>" title="Visualizar">Visualizar</a>
                            <a href="<?= baseUrl() ?>Cidade/form/update/<?= $value['id'] ?>" title="Alterar">Alterar</a>
                            <a href="<?= baseUrl() ?>Cidade/form/delete/<?= $value['id'] ?>" title="Excluir">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

<?php else: ?>

    <div class="alert alert-warning mt-5 mb-5" role="alert">
        Não foram localizados registros...
    </div>

<?php endif; ?>