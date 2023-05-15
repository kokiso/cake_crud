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
                        <th class="actions"><?= __('Actions'); ?></th>
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
                        <td class="actions">
                            <?= $this->Html->link(
                                '<span class="fa fa-search"></span><span class="sr-only">' . __('View') . '</span>',
                                ['action' => 'view', $venda->vendas['id']],
                                ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-sm']
                            ) ?>
                            <?= $this->Html->link(
                                '<span class="fa fa-eye"></span><span class="sr-only">' . __('Edit') . '</span>',
                                ['action' => 'edit', $venda->vendas['id']],
                                ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']
                            ) ?>
                            <?= $this->Form->postLink(
                                '<span class="fa fa-trash"></span><span class="sr-only">' . __('Delete') . '</span>',
                                ['action' => 'delete', $venda->vendas['id']],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $venda->vendas['id']), 'escape' => false, 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']
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