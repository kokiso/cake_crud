<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?= $this->Form->create($venda); ?>
                <fieldset>
                    <legend><?= __('Edit {0}', ['Vendas']) ?></legend>
                    <?php
                    echo $this->Form->control('Vendas.id_cliente', [
                        'options' => $clientesData,
                        'empty' => true,
                        'required' => false
                    ]); 

                    echo $this->Form->control('Vendas.id_vendedor', [
                        'options' => $vendedoresData,
                        'empty' => true,
                        'required' => false
                    ]); 
                    
                    echo $this->Form->control('Vendas.id_produto', [
                        'options' => $produtosData,
                        'empty' => 'Select an option'
                    ]);   
                    echo $this->Form->control('Vendas.quantidade');
                    echo $this->Form->control('Vendas.data_venda', ['id' => 'data_venda']);
                    ?>
                </fieldset>
            <?= $this->Form->button(__("Salvar"),['escape' => false, 'class' => 'btn btn-success']); ?>
            <?= $this->Html->link(
                                'Voltar',
                                ['action' => '../vendas/index'],
                                ['escape' => false, 'class' => 'btn btn-warning']
                            ) ?>
            <?= $this->Form->end() ?>
        </main>
    </div>
</div>
