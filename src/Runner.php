<?php
/* 
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

namespace CakeApiConnector;

use CakeApiConnector\Connector\RunnerInterface;
use CakeApiConnector\Model\Entity\Dataobject;
use CakeApiConnector\Model\Table\DataobjectsTable;
use Cake\ORM\TableRegistry;
use Exception;

class Runner {
    
    public static function run($data, array $options = []) : bool
    {
        if (is_int($data)) {
            $dataobject = static::getDataobjectById($data);
        } elseif ($data instanceof Dataobject) {
            $dataobject = $data;
        } else {
            throw new Exception("\$data should be a Dataobject interface or an integer");
        }
        
        return static::execute($dataobject->runner_class, $dataobject, $options);
    }
    
    /**
     * Execute the runner
     * @param RunnerInterface $runner
     * @param Dataobject $data
     * @return bool
     */
    private static function execute(RunnerInterface $runner, Dataobject $dataobject, array $options = []) : bool
    {
        static::getDataobjectsTable()->setStatus($dataobject, Dataobject::STATUS_BUSY);
        
        $event = $runner->initiate($dataobject);
        
        $runner->beforeCall($dataobject, $event, $options);
        
        if (!$event->isStopped()) {
            $runner->call($dataobject, $event, $options);
        }
        
        if (!$event->isStopped()) {
            $runner->afterCall($dataobject, $event, $options);
        }
        
        return !$event->isStopped();
    }
    
    /**
     * Return the DataObject identified by $id
     * @param int $id
     * @return Dataobject
     */
    private static function getDataobjectById(int $id) : Dataobject
    {
        return static::getDataobjectsTable()->get($id);
    }
    
    /**
     * Return the DataObjectsTable
     * @return DataobjectsTable
     */
    private static function getDataobjectsTable() : DataobjectsTable
    {
        return TableRegistry::getTableLocator()->get('CakeApiConnector.Dataobjects');
    }
}