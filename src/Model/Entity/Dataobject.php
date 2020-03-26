<?php
namespace CakeApiConnector\Model\Entity;

use Cake\ORM\Entity;
use CakeApiConnector\Connector\RunnerInterface;
use CakeApiConnector\Connector\BaseRunner;
use Exception;

/**
 * CakeApiConnectorDataobject Entity
 *
 * @property int $id
 * @property string|null $foreign_id
 * @property string|null $parent_id
 * @property string|null $parent_model
 * @property string|null $entity_id  To store CakeEntity
 * @property string|null $entity ClassName of Entity 
 * @property string|null $runner
 * @property string|resource|null $data
 * @property \Cake\I18n\FrozenTime|null $created
 * @property int|null $created_by
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $modified_by
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property int|null $deleted_by
 *
 * @property \App\Model\Entity\Foreign $foreign
 * @property \App\Model\Entity\ParentCakeApiConnectorDataobject $parent_cake_api_connector_dataobject
 * @property \App\Model\Entity\ChildCakeApiConnectorDataobject[] $child_cake_api_connector_dataobjects
 */
class Dataobject extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'site_id' => true,
        'language' => true,
        'foreign_id' => true,
        'parent_id' => true,
        'parent_model' => true,
        'entity_id' => true,
        'entity' => true,
        'runner' => true,
        'data' => true,
        'created' => true,
        'created_by' => true,
        'modified' => true,
        'modified_by' => true,
        'deleted' => true,
        'deleted_by' => true,
    ];
    
    /**
     * Return a runner class. if defined in $this->runner
     * otherwise, return BaseRunner
     * 
     * It automagically checks for a $runner in the App\Runner or CakeApiConnector\Runner
     * folder
     * 
     * @return RunnerInterface
     */
    public function _getRunnerClass() : RunnerInterface
    {
        if (empty($this->runner)) {
            $class_name = BaseRunner::class;
        } else {
            $class_name = $this->runner;
        }
        
        
        
        $namespaces_to_search_in = [
            "",
            "App\\Runner\\",
            "CakeApiConnector\\Runner\\"
        ];
        
        foreach ($namespaces_to_search_in as $ns) {
            if (class_exists($ns . $class_name)) {
                return new $class_name();
            }
        }
        
        throw new Exception("Class name $class_name not found");
    }
}
