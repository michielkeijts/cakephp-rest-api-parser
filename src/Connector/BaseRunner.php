<?php
/* 
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

namespace CakeApiConnector\Connector;

use Cake\Event\Event;
use Cake\Core\Exception\Exception;
use CakeApiConnector\Model\Entity\Dataobject;
use CakeApiConnector\Model\Table\DataobjectsTable;
use Cake\ORM\TableRegistry;

class BaseRunner implements RunnerInterface {
    
    /**
     * Initiate the Runner, should create an Event
     * @return Event
     */
    public function initiate(Dataobject $dataobject) : Event
    {
        $parts = explode("\\", get_called_class());
        $className = end($parts);
        $event = new Event($className . " Execution");
        $event->setData('dataobject',$dataobject);
        return $event;
    }
        
    /**
     * Execute the before call action
     * @param Dataobject $dataobject
     * @param Event $event
     * @param array $options
     */
    public function beforeCall(Dataobject $dataobject, Event $event, array $options = []) {
        
    }
    
    /**
     * Execute the call to an api or such
     * @param Dataobject $dataobject
     * @param Event $event
     * @param array $options
     * @return bool if success
     */
    public function call(Dataobject $dataobject, Event $event,array $options = []) : bool
    {
        return true;
    }
    
    /**
     * When a successfull call, call this aftercall function
     * @param Dataobject $dataobject
     * @param Event $event
     * @param array $options
     */
    public function afterCall(Dataobject $dataobject, Event $event, array $options = [] ) {
        
    }    
    
    /**
     * Helper function to throw an exception
     * @param string $message
     * @param Event $event
     * @throws Exception
     */
    public function throwException(string $message, Event $event)
    {
        $this->getDataobjectsTable()->setStatus($event->getData('dataobject'), Dataobject::STATUS_ERROR);
        
        $event->stopPropagation();
        
        throw new Exception($event->getName() . ' error: ' . $message);
    }
    
    /**
     * Get the Table Interface
     * @return DataobjectsTable
     */
    protected function getDataobjectsTable() : DataobjectsTable
    {
        return TableRegistry::getTableLocator()->get('CakeApiConnector.Dataobjects');
    }
}