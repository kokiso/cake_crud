<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <table class="table table-striped" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                        <th class="actions"><?= __('Actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendedores as $vendedore): ?>
                     <tr>
                        <td><?= $this->Number->format($vendedore->id) ?></td>
                        <td><?= h($vendedore->nome) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(
                                '<span class="fa fa-search"></span><span class="sr-only">' . __('View') . '</span>',
                                ['action' => 'view', $vendedore->id],
                                ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-sm']
                            ) ?>
                            <?= $this->Html->link(
                                '<span class="fa fa-eye"></span><span class="sr-only">' . __('Edit') . '</span>',
                                ['action' => 'edit', $vendedore->id],
                                ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']
                            ) ?>
                            <?= $this->Form->postLink(
                                '<span class="fa fa-trash"></span><span class="sr-only">' . __('Delete') . '</span>',
                                ['action' => 'delete', $vendedore->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $vendedore->id), 'escape' => false, 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']
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