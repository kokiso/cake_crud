<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Venda Entity
 *
 * @property int $id
 * @property int $id_produto
 * @property int $id_vendedor
 * @property int $id_cliente
 * @property int $quantidade
 * @property \Cake\I18n\FrozenTime $data_venda
 */
class Venda extends Entity
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
        'id_produto' => true,
        'id_vendedor' => true,
        'id_cliente' => true,
        'quantidade' => true,
        'data_venda' => true,
    ];
}
