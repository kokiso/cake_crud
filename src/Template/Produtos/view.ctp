<?= $this->element('bootstrap') ?>
<div class="container-fluid">
    <div class="row">
    <?= $this->element('sidebar') ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="panel panel-default">
                <!-- Panel header -->
                <div class="panel-heading">
                    <h3 class="panel-title"><?= h($produto->id) ?></h3>
                </div>
                <table class="table table-striped" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><?= __('Nome') ?></td>
                        <td><?= h($produto->nome) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Id') ?></td>
                        <td><?= $this->Number->format($produto->id) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Quantidade') ?></td>
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
                    </tr>
                    <tr>
                        <td><?= __('Preco') ?></td>
                        <td>R$<?= $this->Number->format($produto->preco) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Data Validade') ?></td>
                        <td><?= h($produto->data_validade) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Data Fabricacao') ?></td>
                        <td><?= h($produto->data_fabricacao) ?></td>
                    </tr>
                    <tr>
                        <td><?= __('Produto Perecivel') ?></td>
                        <td><?= $produto->produto_perecivel ? __('Yes') : __('No'); ?></td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
</div>



