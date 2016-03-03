<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LancamentosFixture
 *
 */
class LancamentosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'categoria_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'forma_pagamento_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'conta_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fornecedor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'valor' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'fk_lancamentos_categorias1_idx' => ['type' => 'index', 'columns' => ['categoria_id'], 'length' => []],
            'fk_lancamentos_forma_pagamentos1_idx' => ['type' => 'index', 'columns' => ['forma_pagamento_id'], 'length' => []],
            'fk_lancamentos_contas1_idx' => ['type' => 'index', 'columns' => ['conta_id'], 'length' => []],
            'fk_lancamentos_fornecedores1_idx' => ['type' => 'index', 'columns' => ['fornecedor_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_lancamentos_categorias1' => ['type' => 'foreign', 'columns' => ['categoria_id'], 'references' => ['categorias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_lancamentos_forma_pagamentos1' => ['type' => 'foreign', 'columns' => ['forma_pagamento_id'], 'references' => ['forma_pagamentos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_lancamentos_contas1' => ['type' => 'foreign', 'columns' => ['conta_id'], 'references' => ['contas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_lancamentos_fornecedores1' => ['type' => 'foreign', 'columns' => ['fornecedor_id'], 'references' => ['fornecedores', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'categoria_id' => 1,
            'forma_pagamento_id' => 1,
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 1
        ],
    ];
}
