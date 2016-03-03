<?php
namespace App\Model\Table;

use App\Model\Entity\Lancamento;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lancamentos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categorias
 * @property \Cake\ORM\Association\BelongsTo $FormaPagamentos
 * @property \Cake\ORM\Association\BelongsTo $Contas
 * @property \Cake\ORM\Association\BelongsTo $Fornecedores
 */
class LancamentosTable extends Table
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

        $this->table('lancamentos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('FormaPagamentos', [
            'foreignKey' => 'forma_pagamento_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Contas', [
            'foreignKey' => 'conta_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Fornecedores', [
            'foreignKey' => 'fornecedor_id',
            'joinType' => 'LEFT'
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
            ->add('valor', 'valid', ['rule' => 'numeric'])
            ->requirePresence('valor', 'create')
            ->notEmpty('valor');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['categoria_id'], 'Categorias'));
        $rules->add($rules->existsIn(['forma_pagamento_id'], 'FormaPagamentos'));
        $rules->add($rules->existsIn(['conta_id'], 'Contas'));
        $rules->add($rules->existsIn(['fornecedor_id'], 'Fornecedores'));
        return $rules;
    }
}
