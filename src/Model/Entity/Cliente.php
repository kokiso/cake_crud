<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $endereco
 * @property string $documento
 * @property string $email
 * @property \Cake\I18n\FrozenTime $data_cadastro
 */
class Cliente extends Entity
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
        'endereco' => true,
        'documento' => true,
        'email' => true,
        'data_cadastro' => true,
    ];
}
