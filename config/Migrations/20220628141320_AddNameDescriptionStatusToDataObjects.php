<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddNameDescriptionStatusToDataObjects extends AbstractMigration
{
    public function change()
    {
        $this->table('cake_api_connector_dataobjects')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 150,
                'after' => 'entity',
                'null' => true,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => MysqlAdapter::TEXT_REGULAR,
                'after' => 'name',
                'null' => true,
            ])
            ->addColumn('status', 'string', [
                'default' => null,
                'limit' => 64,
                'after' => 'description',
                'null' => true,
            ])
            ->update();

        $this->table('cake_api_connector_dataobjects')
            ->addIndex(
                [
                    'entity',
                    'entity_id',
                    'name'
                ],
                [
                    'name' => 'entity_name',
                ]
            )
            ->addIndex(
                [
                    'name',
                    'entity',
                ],
                [
                    'name' => 'name_entity',
                ]
            )
            ->addIndex(
                [
                    'status',
                    'name',
                    'entity',
                    'entity_id',
                    'foreign_id'
                ],
                [
                    'name' => 'status_name',
                ]
            )
            ->addIndex(
                [
                    'site_id',
                    'language',
                    'name',
                    'status',
                    'parent_id',
                    'parent_model'
                ],
                [
                    'name' => 'status_update_name',
                ]
            )
            ->addIndex(
                [
                    'site_id',
                    'language',
                    'name',
                    'status',
                    'foreign_id',
                    'parent_id',
                    'parent_model',
                    'entity',
                    'runner_status',
                    'notbefore',
                ],
                [
                    'name' => 'order_update_name_status',
                ]
            )
            ->update();
    }
}