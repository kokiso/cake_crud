<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Produto Entity
 *
 * @property int $id
 * @property string $nome
 * @property int $unidade_medida
 * @property float $quantidade
 * @property float $preco
 * @property bool $produto_perecivel
 * @property \Cake\I18n\FrozenTime $data_validade
 * @property \Cake\I18n\FrozenTime $data_fabricacao
 */
class Produto extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'unidade_medida' => true,
        'quantidade' => true,
        'preco' => true,
        'produto_perecivel' => true,
        'data_validade' => true,
        'data_fabricacao' => true,
    ];
}
