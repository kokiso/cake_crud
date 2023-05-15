<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?= $this->Form->create($cliente) ?>
            <fieldset>
                <legend><?= __('Edit') ?></legend>
                <?php
                    echo $this->Form->control('nome');
                ?>
            </fieldset>
            <?= $this->Form->button(__("Salvar"),['escape' => false, 'class' => 'btn btn-success']); ?>
            <?= $this->Html->link(
                                'Voltar',
                                ['action' => '../clientes/index'],
                                ['escape' => false, 'class' => 'btn btn-warning']
                            ) ?>
            <?= $this->Form->end() ?>
        </main>
    </div>
</div>
