<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CopyData extends AbstractMigration
{
    public function up()
    {
        $start = date('Y-m-d H:i:s', time());
        $step = 1e4;
        $i=0;

        do {
            $min_id = $i;
            $i+=$step;
            $max_id = $i;

            echo "INSERTING.. $min_id .. $max_id\n";
            $this->execute("INSERT INTO cake_api_connector_dataobjects_tmp SELECT * FROM cake_api_connector_dataobjects WHERE id>$min_id && id<={$max_id}");
        } while ($i <= $this->getMax());


        $this->table("cake_api_connector_dataobjects")->rename('cake_api_connector_dataobjects_old')->save();
        $this->table("cake_api_connector_dataobjects_tmp")->rename('cake_api_connector_dataobjects')->save();
    }

    public function down() {

    }

    private function getMax() :int
    {
        return $this->query("SELECT MAX(id) as ct FROM cake_api_connector_dataobjects")->fetchAssoc()['ct'];
    }
}
