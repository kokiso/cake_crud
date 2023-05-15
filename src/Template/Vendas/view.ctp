<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="panel panel-default">
                <!-- Panel header -->
                <div class="panel-heading">
                    <h3 class="panel-title"><?= h($venda->vendas['id']) ?></h3>
                </div>
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?= __('Id') ?></td>
                        <td><?= $this->Number->format($venda->vendas['id']) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Vendedor') ?></td>
                        <td><?= h($venda->vendedores['nome']) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Cliente') ?></td>
                        <td><?= h($venda->clientes['nome']) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Produto') ?></td>
                        <td><?= h($venda->produtos['nome']) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Quantidade') ?></td>
                        <td><?= h($venda->vendas['quantidade']) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Data de venda') ?></td>
                        <td><?= h(date("d/m/Y", strtotime($venda->vendas['data_venda']))) ?></td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
</div>
