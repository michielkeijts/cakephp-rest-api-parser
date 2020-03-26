<?php
/* 
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

namespace CakeApiConnector;

use CakeApiConnector\Connector\RunnerInterface;
use CakeApiConnector\Model\Entity\Dataobject;
use Cake\ORM\TableRegistry;
use Exception;
use Cake\Event\Event;

class Runner {
    
    public static function run($data, array $options = []) : bool
    {
        if (is_int($data)) {
            $dataobject = static::getDataobjectById($data);
        } elseif ($data instanceof RunnerInterface) {
            $dataobject = $data;
        } else {
            throw new Exception("\$data should be a Dataobject interface or an integer");
        }
        
        return static::execute($dataobject->runner_class, $data);
    }
    
    /**
     * Execute the runner
     * @param RunnerInterface $runner
     * @param Dataobject $data
     * @return bool
     */
    private static function execute(RunnerInterface $runner, Dataobject $data, array $options) : bool
    {
        $event = $runner->initiate();
        
        $runner->beforeCall($dataobject, $event, $options);
        
        if (!$event->isStopped()) {
            $runner->call($dataobject, $event, $options);
        }
        
        if (!$event->isStopped()) {
            $runner->afterCall($dataobject, $event, $options);
        }
    }
    
    /**
     * Return the DataObject identified by $id
     * @param int $id
     * @return Dataobject
     */
    private static function getDataobjectById(int $id) : Dataobject
    {
        return TableRegistry::getTableLocator()->get('Dataobjects')->get($id);
    }
}