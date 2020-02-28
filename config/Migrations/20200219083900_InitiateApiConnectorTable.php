<?php
use Migrations\AbstractMigration;

class InitiateApiConnectorTable extends AbstractMigration
{

    public function up()
    {

        $this->table('cake_api_connector_dataobjects')
            ->addColumn('foreign_id', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => true,
            ])
            ->addColumn('parent_id', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => true,
            ])
            ->addColumn('parent_model', 'string', [
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('entity_id', 'string', [
                'default' => null,
                'limit' => 64,
                'null' => true,
            ])
            ->addColumn('entity', 'string', [
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('runner', 'string', [
                'default' => null,
                'limit' => 128,
                'null' => true,
            ])
            ->addColumn('data', 'blob', [
                'default' => null,
                'limit' => 4294967295,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('deleted', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('deleted_by', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addIndex(
                [
                    'deleted',
                    'foreign_id',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'parent_id',
                    'parent_model',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'entity_id',
                    'entity',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'foreign_id',
                    'parent_id',
                    'parent_model',
                    'entity_id',
                    'entity',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'created',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'modified',
                ]
            )
            ->create();
    }

    public function down()
    {

        $this->table('cake_api_connector_dataobjects')->drop()->save();
    }
}

