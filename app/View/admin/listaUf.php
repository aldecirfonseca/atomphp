<?= formTitulo("Lista UF", true) ?>

<div class="m-2">

    <table class="table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Sigla</th>
                <th scope="col">Descrição</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aDados as $value): ?>
                <tr>
                    <th scope="row"><?= $value['id'] ?></th>
                    <td><?= $value['sigla'] ?></td>
                    <td><?= $value['descricao'] ?></td>
                    <td>
                        <a href="<?= baseUrl() ?>Uf/form/view/<?= $value['id'] ?>" title="Visualizar">Visualizar</a>
                        <a href="<?= baseUrl() ?>Uf/form/update/<?= $value['id'] ?>" title="Alterar">Alterar</a>
                        <a href="<?= baseUrl() ?>Uf/form/delete/<?= $value['id'] ?>" title="Excluir">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>