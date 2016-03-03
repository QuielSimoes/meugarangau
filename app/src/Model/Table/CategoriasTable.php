<?php

namespace App\Model\Table;

use App\Model\Entity\Categoria;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categorias Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categorias
 * @property \Cake\ORM\Association\HasMany $Categorias
 */
class CategoriasTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('categorias');
        $this->displayField('nome');
        $this->primaryKey('id');

        $this->belongsTo('Categorias', [
            'foreignKey' => 'categoria_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Categorias', [
            'foreignKey' => 'categoria_id'
        ]);

        $this->addBehavior('Tree', [
            'parent' => 'categoria_id', // Use this instead of parent_id
            'left' => 'esquerda', // Use this instead of lft
            'right' => 'direita' // Use this instead of rght
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('nome', 'create')
                ->notEmpty('nome');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['categoria_id'], 'Categorias'));
        return $rules;
    }

}
