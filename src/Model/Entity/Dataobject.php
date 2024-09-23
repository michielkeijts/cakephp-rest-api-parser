<?php
namespace CakeApiConnector\Model\Entity;

use Cake\ORM\Entity;
use CakeApiConnector\Connector\RunnerInterface;
use CakeApiConnector\Connector\BaseRunner;
use Exception;
use ReflectionClass;

/**
 * CakeApiConnectorDataobject Entity
 *
 * @property int $id
 * @property int $site_id
 * @property string|null $locale
 * @property string|null $foreign_id
 * @property string|null $parent_id
 * @property string|null $parent_model
 * @property string|null $entity_id  To store CakeEntity
 * @property string|null $entity ClassName of Entity
 * @property string|null $runner
 * @property string|null $runner_status
 * @property \Cake\I18n\FrozenTime|null $notbefore
 * @property string|null $status
 * @property string|null $description
 * @property string|null $name
 * @property array $data
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
     * List of possible runner_status
     */
    const STATUS_WAITING = 'WAITING';
    const STATUS_BUSY = 'BUSY';
    const STATUS_READY = 'READY';
    const STATUS_DELETED = 'DELETED';
    const STATUS_ERROR = 'ERROR';

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected array $_accessible = [
        'site_id' => true,
        'locale' => true,
        'foreign_id' => true,
        'parent_id' => true,
        'parent_model' => true,
        'entity_id' => true,
        'name' => true,
        'status' => true,
        'description' => true,
        'entity' => true,
        'runner' => true,
        'runner_status' => true,
        'notbefore' => true,
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
            $fqn = $ns.$class_name;
            if (class_exists($fqn)) {
                return new $fqn();
            }
        }

        throw new Exception("Class name $class_name not found");
    }

    /**
     * When status is WAITING
     * @return bool
     */
    public function isEditable() : bool
    {
        return !(in_array($this->runner_status, ['BUSY']) && !$this->isDirty('runner_status'));
    }

    /**
     * Return all the valid statusses for the object
     * @return array
     */
    public static function getValidStatusses() : array
    {
        $reflector = new ReflectionClass(self::class);
        $statusses = [];
        foreach ($reflector->getConstants() as $key=>$value) {
            if (substr($key,0,7) !== 'STATUS_') {
                continue;
            }
            $statusses[]=$value;
        }

        return $statusses;
    }
}
