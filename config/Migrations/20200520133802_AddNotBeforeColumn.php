<?php
use Migrations\AbstractMigration;

class AddNotBeforeColumn extends AbstractMigration
{

    public function up()
    {
        $this->table('cake_api_connector_dataobjects')
            ->addColumn('notbefore', 'datetime', [
                'after' => 'runner',
                'default' => '2020-05-20 00:00:00',
                'null' => false,
            ])
            ->addIndex(
                [
                    'deleted',
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
                    'name' => 'order_update',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('cake_api_connector_dataobjects')
            ->removeIndexByName('order_update')
            ->update();

        $this->table('cake_api_connector_dataobjects')
            ->removeColumn('notbefore')
            ->update();
    }
}

