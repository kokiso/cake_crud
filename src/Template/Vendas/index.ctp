<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
    <div>
        <?= $this->Form->create(null, ['type' => 'get']) ?>
            <fieldset>
                <legend><?= __('Filter') ?></legend>
                <div class="form-group">
                    <label><?= __('From') ?></label>
                    <div class="input-group date">
                        <?= $this->Form->text('min_date', ['class' => 'form-control', 'data-provide' => 'datepicker', 'value' => $this->request->getQuery('min_date')]) ?>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><?= __('To') ?></label>
                    <div class="input-group date">
                        <?= $this->Form->text('max_date', ['class' => 'form-control', 'data-provide' => 'datepicker', 'value' => $this->request->getQuery('max_date')]) ?>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
            </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
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
                        <th class="actions"><?= __('Actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendas as $venda): ?>
                     <tr>
                        <td><?= $this->Number->format($venda->id) ?></td>
                        <td><?= h($venda->Produtos->nome) ?></td>
                        <td><?= h($venda->Clientes->nome) ?></td>
                        <td><?= h($venda->Vendedores->nome) ?></td>
                        <td><?= h($venda->quantidade) ?></td>
                        <td><?= h($venda->data_cadastro) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(
                                '<span class="fa fa-search"></span><span class="sr-only">' . __('View') . '</span>',
                                ['action' => 'view', $venda->id],
                                ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-sm']
                            ) ?>
                            <?= $this->Html->link(
                                '<span class="fa fa-eye"></span><span class="sr-only">' . __('Edit') . '</span>',
                                ['action' => 'edit', $venda->id],
                                ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']
                            ) ?>
                            <?= $this->Form->postLink(
                                '<span class="fa fa-trash"></span><span class="sr-only">' . __('Delete') . '</span>',
                                ['action' => 'delete', $venda->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $venda->id), 'escape' => false, 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('create') ?>
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
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
    });
});
</script>