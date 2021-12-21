<?php
use Migrations\AbstractMigration;

class AddNonDeletedIndexes extends AbstractMigration
{
    public function up()
    {
        $this->table('cake_api_connector_dataobjects')
            ->addIndex(
                [
                    'entity',
                    'entity_id',
                ],
                [
                    'name' => 'entity',
                ]
            )
            ->addIndex(
                [
                    'entity',
                    'foreign_id',
                ],
                [
                    'name' => 'new',
                ]
            )
            ->addIndex(
                [
                    'data',
                ],
                [
                    'name' => 'data',
                    'limit' => 200
                ]
            )
                ->addIndex(
                [
                    'site_id',
                    'language',
                    'foreign_id',
                    'parent_id',
                    'parent_model',
                    'entity',
                    'runner_status'
                ],
                [
                    'name' => 'status_update_nd',
                ]
            )
            ->addIndex(
                [
                    'site_id',
                    'language',
                    'foreign_id',
                    'parent_id',
                    'parent_model',
                    'entity',
                    'runner_status',
                    'notbefore',
                ],
                [
                    'name' => 'order_update_nd',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('cake_api_connector_dataobjects')
            ->removeIndexByName('entity')
            ->removeIndexByName('new')
            ->removeIndexByName('data')
            ->removeIndexByName('status_update_nd')
            ->removeIndexByName('order_update_nd')
            ->update();
    }
}

