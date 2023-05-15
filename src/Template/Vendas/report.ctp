<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <table class="table table-striped" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id'); ?></th>
                        <th><?= $this->Paginator->sort('Vendedor'); ?></th>
                        <th><?= $this->Paginator->sort('Cliente'); ?></th>
                        <th><?= $this->Paginator->sort('Produto'); ?></th>
                        <th><?= $this->Paginator->sort('Quantidade'); ?></th>
                        <th><?= $this->Paginator->sort('Data de venda'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendas as $venda): ?>
                     <tr>
                        <td><?= $this->Number->format($venda->vendas['id']) ?></td>
                        <td><?= h($venda->vendedores['nome']) ?></td>
                        <td><?= h($venda->clientes['nome']) ?></td>
                        <td><?= h($venda->produtos['nome']) ?></td>
                        <td><?= h($venda->vendas['quantidade']) ?></td>
                        <td><?= h((date("d/m/Y", strtotime($venda->vendas['data_venda'])))) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </main>
    </div>
</div>

<script>
$(function() {
    $('.input-group.date').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,
    });
});
</script>