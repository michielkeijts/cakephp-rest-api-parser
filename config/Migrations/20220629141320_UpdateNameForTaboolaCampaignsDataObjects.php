<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class UpdateNameForTaboolaCampaignsDataObjects extends AbstractMigration
{
    public function up()
    {
        $rows = $this->fetchAll("SELECT * FROM cake_api_connector_dataobjects WHERE entity='TaboolaCampaignTemplate'");

        foreach ($rows as $row) {
            $data = unserialize($row['data']);

            $this->execute(sprintf("UPDATE cake_api_connector_dataobjects SET name = '%s' WHERE id = %d",$data['name'], $row['id']));
        }
    }        
}