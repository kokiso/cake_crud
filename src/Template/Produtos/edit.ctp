<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?= $this->Form->create($produto); ?>
                <fieldset>
                <legend><?= __('Edit {0}', ['Produto']) ?></legend>
                    <?php
                    echo $this->Form->control('nome');
                    echo $this->Form->select('unidade_medida', [
                        1 => 'Litro',
                        2 => 'Kilograma',
                        3 => 'Unidade',
                    ]);
                    // echo $this->Form->control('unidade_medida');
                    echo $this->Form->control('quantidade');
                    echo $this->Form->control('preco');
                    echo $this->Form->control('produto_perecivel');
                    echo $this->Form->control('data_validade', ['id' => 'data_validade']);
                    echo $this->Form->control('data_fabricacao', ['id' => 'data_fabricacao']);
                    ?>
                </fieldset>
            <?= $this->Form->button(__("Salvar"),['escape' => false, 'class' => 'btn btn-success']); ?>
            <?= $this->Html->link(
                                'Voltar',
                                ['action' => '../produtos/index'],
                                ['escape' => false, 'class' => 'btn btn-warning']
                            ) ?>
            <?= $this->Form->end() ?>
        </main>
    </div>
</div>

<script>
$(document).ready(function() {
    $('form').validate({
        rules: {
            'data_fabricacao': {
                required: true,
                lessThanOrEqual: '#data_validade'
            }
        },
        messages: {
            'data_fabricacao': {
                required: 'Please enter a creation date',
                lessThanOrEqual: 'Creation date must be less than or equal to release date'
            }
        }
    });
});
</script>