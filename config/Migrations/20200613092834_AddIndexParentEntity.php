<?php
use Migrations\AbstractMigration;

class AddIndexParentEntity extends AbstractMigration
{

    public function up()
    {
        $this->table('cake_api_connector_dataobjects')
            ->addIndex(
                [
                    'parent_id',
                    'parent_model',
                    'entity',
                    'entity_id',
                ],
                [
                    'name' => 'parent_relation',
                ]
            )
            ->update();
    }

    public function down()
    {

        $this->table('cake_api_connector_dataobjects')
            ->removeIndexByName('parent_relation')
            ->update();
    }
}

