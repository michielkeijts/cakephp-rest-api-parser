<?php
/* 
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

namespace CakeApiConnector\Connector;

use Cake\Event\Event;
use CakeApiConnector\Model\Entity\Dataobject;

interface RunnerInterface {
    
    /**
     * Initiate the Runner, should create an Event
     * @return Event
     */
    public function initiate(Dataobject $dataobject) : Event;
        
    /**
     * Execute the before call action
     * @param Dataobject $dataobject
     * @param Event $event
     * @param array $options
     */
    public function beforeCall(Dataobject $dataobject, Event $event, array $options = []);
    
    /**
     * Execute the call to an api or such
     * @param Dataobject $dataobject
     * @param Event $event
     * @param array $options
     * @return bool if success
     */
    public function call(Dataobject $dataobject, Event $event,array $options = []) : bool;
    
    /**
     * When a successfull call, call this aftercall function
     * @param Dataobject $dataobject
     * @param Event $event
     * @param array $options
     */
    public function afterCall(Dataobject $dataobject, Event $event, array $options = [] );
}