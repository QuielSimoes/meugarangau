<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lancamento Entity.
 *
 * @property int $id
 * @property int $categoria_id
 * @property \App\Model\Entity\Categoria $categoria
 * @property int $forma_pagamento_id
 * @property \App\Model\Entity\FormaPagamento $forma_pagamento
 * @property int $conta_id
 * @property \App\Model\Entity\Conta $conta
 * @property int $fornecedor_id
 * @property \App\Model\Entity\Fornecedore $fornecedore
 * @property float $valor
 */
class Lancamento extends Entity
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
