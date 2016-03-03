<?php
namespace App\Model\Table;

use App\Model\Entity\FormaPagamento;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormaPagamentos Model
 *
 * @property \Cake\ORM\Association\HasMany $Lancamentos
 */
class FormaPagamentosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('forma_pagamentos');
        $this->displayField('nome');
        $this->primaryKey('id');

        $this->hasMany('Lancamentos', [
            'foreignKey' => 'forma_pagamento_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        return $validator;
    }
}
