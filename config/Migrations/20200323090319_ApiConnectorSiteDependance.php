<?php
use Migrations\AbstractMigration;

class ApiConnectorSiteDependance extends AbstractMigration
{

    public function up()
    {
        $this->table('cake_api_connector_dataobjects')
            ->removeIndexByName('deleted_3')
            ->removeIndexByName('deleted_4')
            ->removeIndexByName('deleted_5')
            ->update();

        $this->table('cake_api_connector_dataobjects')
            ->addColumn('site_id', 'integer', [
                'after' => 'foreign_id',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('language', 'string', [
                'after' => 'site_id',
                'default' => null,
                'length' => 10,
                'null' => true,
            ])
            ->addIndex(
                [
                    'deleted',
                    'site_id',
                    'language',
                    'foreign_id',
                    'parent_id',
                    'parent_model',
                    'entity_id',
                    'entity',
                ],
                [
                    'name' => 'deleted7',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'modified',
                ],
                [
                    'name' => 'deleted_6',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'entity_id',
                    'entity',
                ],
                [
                    'name' => 'deleted_3',
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
                ],
                [
                    'name' => 'deleted_4',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'created',
                ],
                [
                    'name' => 'deleted_5',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('cake_api_connector_dataobjects')
            ->removeIndexByName('deleted7')
            ->removeIndexByName('deleted_6')
            ->removeIndexByName('deleted_3')
            ->removeIndexByName('deleted_4')
            ->removeIndexByName('deleted_5')
            ->update();

        $this->table('cake_api_connector_dataobjects')
            ->removeColumn('site_id')
            ->removeColumn('language')
            ->removeColumn('entity_id')
            ->removeColumn('entity')
            ->addIndex(
                [
                    'deleted',
                    'foreign_id',
                    'parent_id',
                    'parent_model',
                ],
                [
                    'name' => 'deleted_3',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'created',
                ],
                [
                    'name' => 'deleted_4',
                ]
            )
            ->addIndex(
                [
                    'deleted',
                    'modified',
                ],
                [
                    'name' => 'deleted_5',
                ]
            )
            ->update();
    }
}

