<?php
namespace App\Model\Table;

use App\Model\Entity\Meta;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Metas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categorias
 */
class MetasTable extends Table
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

        $this->table('metas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
            'joinType' => 'INNER'
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

        $validator
            ->requirePresence('tp_controle', 'create')
            ->notEmpty('tp_controle');

        $validator
            ->add('dt_inicial', 'valid', ['rule' => 'date'])
            ->requirePresence('dt_inicial', 'create')
            ->notEmpty('dt_inicial');

        $validator
            ->add('dt_final', 'valid', ['rule' => 'date'])
            ->requirePresence('dt_final', 'create')
            ->notEmpty('dt_final');

        $validator
            ->add('vl_meta', 'valid', ['rule' => 'numeric'])
            ->requirePresence('vl_meta', 'create')
            ->notEmpty('vl_meta');

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
        return $rules;
    }
}
