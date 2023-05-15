<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="panel panel-default">
                <!-- Panel header -->
                <div class="panel-heading">
                    <h3 class="panel-title"><?= h($cliente->id) ?></h3>
                </div>
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="row"><?= __('Nome') ?></th>
                        <td><?= h($cliente->nome) ?></td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
</div>
