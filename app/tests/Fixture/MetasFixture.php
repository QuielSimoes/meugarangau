<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MetasFixture
 *
 */
class MetasFixture extends TestFixture
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
        'nome' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'tp_controle' => ['type' => 'string', 'fixed' => true, 'length' => 1, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'dt_inicial' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'dt_final' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'vl_meta' => ['type' => 'float', 'length' => 12, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'dt_cadastro' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_metas_categorias1_idx' => ['type' => 'index', 'columns' => ['categoria_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_metas_categorias1' => ['type' => 'foreign', 'columns' => ['categoria_id'], 'references' => ['categorias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'nome' => 'Lorem ipsum dolor sit amet',
            'tp_controle' => 'Lorem ipsum dolor sit ame',
            'dt_inicial' => '2016-01-12',
            'dt_final' => '2016-01-12',
            'vl_meta' => 1,
            'dt_cadastro' => 1452639190
        ],
    ];
}
