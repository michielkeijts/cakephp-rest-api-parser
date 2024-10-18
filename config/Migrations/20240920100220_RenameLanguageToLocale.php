<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class RenameLanguageToLocale extends AbstractMigration
{
    public function change()
    {
        $this->table('cake_api_connector_dataobjects')->renameColumn('language','locale')->update();
    }
}
