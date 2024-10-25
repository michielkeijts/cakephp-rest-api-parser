<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddIndexes extends AbstractMigration
{
    public function change()
    {
        if ($this->isMigratingUp()) {
        $this->execute("CREATE TABLE `cake_api_connector_dataobjects_tmp` (
      `id` int NOT NULL AUTO_INCREMENT,
      `foreign_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `site_id` int DEFAULT NULL,
      `locale` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
      `parent_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `parent_model` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `entity_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `entity` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
      `status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `runner` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `notbefore` datetime NOT NULL DEFAULT '2020-05-20 00:00:00',
      `runner_status` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'READY',
      `data` longblob,
      `created` datetime DEFAULT NULL,
      `created_by` int DEFAULT NULL,
      `modified` datetime DEFAULT NULL,
      `modified_by` int DEFAULT NULL,
      `deleted` datetime DEFAULT NULL,
      `deleted_by` int DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `deleted` (`deleted`,`foreign_id`),
      KEY `deleted_2` (`deleted`,`parent_id`,`parent_model`),
      KEY `deleted7` (`deleted`,`site_id`,`locale`,`foreign_id`,`parent_id`,`parent_model`,`entity_id`,`entity`),
      KEY `deleted_6` (`deleted`,`modified`),
      KEY `deleted_3` (`deleted`,`entity_id`,`entity`),
      KEY `deleted_4` (`deleted`,`foreign_id`,`parent_id`,`parent_model`,`entity_id`,`entity`),
      KEY `deleted_5` (`deleted`,`created`),
      KEY `status_update` (`deleted`,`site_id`,`locale`,`foreign_id`,`parent_id`,`parent_model`,`entity`,`runner_status`),
      KEY `order_update` (`deleted`,`site_id`,`locale`,`foreign_id`,`parent_id`,`parent_model`,`entity`,`runner_status`,`notbefore`),
      KEY `parent_relation` (`parent_id`,`parent_model`,`entity`,`entity_id`),
      KEY `entity` (`entity`,`entity_id`),
      KEY `new` (`entity`,`foreign_id`),
      KEY `data` (`data`(200)),
      KEY `status_update_nd` (`site_id`,`locale`,`foreign_id`,`parent_id`,`parent_model`,`entity`,`runner_status`),
      KEY `order_update_nd` (`site_id`,`locale`,`foreign_id`,`parent_id`,`parent_model`,`entity`,`runner_status`,`notbefore`),
      KEY `entity_name` (`entity`,`entity_id`,`name`),
      KEY `name_entity` (`name`,`entity`),
      KEY `status_name` (`status`,`name`,`entity`,`entity_id`,`foreign_id`),
      KEY `status_update_name` (`site_id`,`locale`,`name`,`status`,`parent_id`,`parent_model`),
      KEY `order_update_name_status` (`site_id`,`locale`,`name`,`status`,`foreign_id`,`parent_id`,`parent_model`,`entity`,`runner_status`,`notbefore`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
");}

        $this->table('cake_api_connector_dataobjects_tmp')
            ->addIndex(
                [
                    'foreign_id',
                ]
            )
            ->addIndex(
                [
                    'parent_id',
                    'parent_model',
                ]
            )
            ->addIndex(
                [
                    'entity_id',
                    'entity',
                    'parent_id',
                    'parent_model',
                ]
            )
            ->addIndex(
                [
                    'entity',
                    'entity_id',
                ]
            )
            ->addIndex(
                [
                    'parent_id',
                    'entity',
                ]
            )
            ->addIndex(
                [
                    'parent_id',
                    'parent_model',
                    'entity',
                    'entity_id',
                    'modified',
                ]
            )
            ->addIndex(
                [
                    'foreign_id',
                    'parent_id',
                    'parent_model',
                    'entity',
                    'entity_id',
                    'modified',
                ]
            )
            ->addIndex(
                [
                    'foreign_id',
                    'parent_id',
                    'entity',
                    'name',
                    'status',
                    'modified',
                ]
            )
            ->addIndex(
                [
                    'entity',
                    'name',
                    'modified',
                ]
            )
            ->addIndex(
                [
                    'foreign_id',
                    'entity',
                    'name',
                    'status',
                    'modified',
                ]
            )
            ->addIndex(
                [
                    'foreign_id',
                    'parent_id',
                    'entity',
                    'name',
                    'status',
                    'modified'
                ]
            )
            ->addIndex(
                [
                    'entity',
                    'name',
                    'status',
                    'data',
                ],
                [
                    'limit' => 394,
                ]
            )
            ->addIndex(
                [
                    'name',
                    'status',
                    'modified'
                ]
            )
            ->addIndex(
                [
                    'status',
                    'data',
                ],
                [
                    'limit' => 394,
                ]
            )
            ->addIndex(
                [
                    'site_id',
                    'locale',
                    'entity_id',
                    'entity',
                    'name',
                    'modified'
                ]
            )
            ->addIndex(
                [
                    'name',
                    'entity',
                    'entity_id',
                    'modified'
                ]
            )
            ->addIndex(
                [
                    'foreign_id',
                    'name',
                    'entity',
                    'entity_id',
                    'modified'
                ]
            )
            ->addIndex(
                [
                    'data',
                ],
                [
                    'limit' => 394,
                ]
            )
            ->addIndex(
                [
                    'created',
                ]
            )
            ->addIndex(
                [
                    'modified',
                ]
            )
            ->save();
    }
}
