<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <table class="table table-striped" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id'); ?></th>
                        <th><?= $this->Paginator->sort('nome'); ?></th>
                        <th><?= $this->Paginator->sort('quantidade'); ?></th>
                        <th><?= $this->Paginator->sort('preco'); ?></th>
                        <th><?= $this->Paginator->sort('produto_perecivel'); ?></th>
                        <th><?= $this->Paginator->sort('data_fabricacao'); ?></th>
                        <th><?= $this->Paginator->sort('data_validade'); ?></th>
                        <th class="actions"><?= __('Actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                     <tr>
                        <td><?= $this->Number->format($produto->id) ?></td>
                        <td><?= h($produto->nome) ?></td>
                        <?php
                            switch($this->Number->format($produto->unidade_medida)): 
                                case 1: ?>
                                    <td><?=$this->Number->format($produto->quantidade)?>lt</td>
                                <?php break; 
                                case 2: ?>
                                    <td><?=$this->Number->format($produto->quantidade)?>kg</td>
                                <?php break;
                                case 3: ?>
                                    <td><?=$this->Number->format($produto->quantidade)?>un</td>
                            <?php endswitch; 
                        ?>
                        <td>R$<?= $this->Number->format($produto->preco) ?></td>
                        <?php
                            switch($this->Number->format(h($produto->produto_perecivel))): 
                                case 1: ?>
                                    <td>Sim</td>
                                <?php break; 
                                default: ?>
                                    <td>Não</td>
                            <?php endswitch; 
                        ?>
                        <td><?= h(date("d/m/Y", strtotime($produto->data_fabricacao))) ?></td>
                        <td><?= h(date("d/m/Y", strtotime($produto->data_validade))) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(
                                '<span class="fa fa-search"></span><span class="sr-only">' . __('View') . '</span>',
                                ['action' => 'view', $produto->id],
                                ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-sm']
                            ) ?>
                            <?= $this->Html->link(
                                '<span class="fa fa-eye"></span><span class="sr-only">' . __('Edit') . '</span>',
                                ['action' => 'edit', $produto->id],
                                ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-warning btn-sm']
                            ) ?>
                            <?= $this->Form->postLink(
                                '<span class="fa fa-trash"></span><span class="sr-only">' . __('Delete') . '</span>',
                                ['action' => 'delete', $produto->id],
                                ['confirm' => __('Are you sure you want to delete # {0}?', $produto->id), 'escape' => false, 'title' => __('Delete'), 'class' => 'btn btn-danger btn-sm']
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






