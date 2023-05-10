<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vendedore $vendedore
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $vendedore->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $vendedore->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Vendedores'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="vendedores form large-9 medium-8 columns content">
    <?= $this->Form->create($vendedore) ?>
    <fieldset>
        <legend><?= __('Edit Vendedore') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('data_cadastro');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>