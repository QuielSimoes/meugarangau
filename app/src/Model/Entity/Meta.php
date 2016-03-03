<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Meta Entity.
 *
 * @property int $id
 * @property int $categoria_id
 * @property \App\Model\Entity\Categoria $categoria
 * @property string $nome
 * @property string $tp_controle
 * @property \Cake\I18n\Time $dt_inicial
 * @property \Cake\I18n\Time $dt_final
 * @property float $vl_meta
 * @property \Cake\I18n\Time $dt_cadastro
 */
class Meta extends Entity
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
        '*' => true,
        'id' => false,
    ];
}
