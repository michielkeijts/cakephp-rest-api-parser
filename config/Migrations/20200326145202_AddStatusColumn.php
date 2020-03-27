<?php
use Migrations\AbstractMigration;

class AddStatusColumn extends AbstractMigration
{

    public function up()
    {
        $this->table('cake_api_connector_dataobjects')
            ->addColumn('runner_status', 'string', [
                'after' => 'runner',
                'default' => 'READY',
                'length' => 32,
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
                    'status'
                ],
                [
                    'name' => 'status_update',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('cake_api_connector_dataobjects')
            ->removeIndexByName('status_update')
            ->update();

        $this->table('cake_api_connector_dataobjects')
            ->removeColumn('runner_status')
            ->update();
    }
}

