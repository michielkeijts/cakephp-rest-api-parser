<?php
namespace CakeApiConnector\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use ArrayObject;
use CakeApiConnector\Model\Entity\Dataobject;
use Cake\Database\Schema\TableSchemaInterface;

/**
 * CakeApiConnectorDataobjects Model
 *
 * @property \App\Model\Table\ForeignsTable&\Cake\ORM\Association\BelongsTo $Foreigns
 * @property \App\Model\Table\CakeApiConnectorDataobjectsTable&\Cake\ORM\Association\BelongsTo $ParentCakeApiConnectorDataobjects
 * @property \App\Model\Table\CakeApiConnectorDataobjectsTable&\Cake\ORM\Association\HasMany $ChildCakeApiConnectorDataobjects
 *
 * @method \App\Model\Entity\CakeApiConnectorDataobject get($primaryKey, $options = [])
 * @method \App\Model\Entity\CakeApiConnectorDataobject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CakeApiConnectorDataobject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CakeApiConnectorDataobject|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CakeApiConnectorDataobject saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CakeApiConnectorDataobject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CakeApiConnectorDataobject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CakeApiConnectorDataobject findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DataobjectsTable extends Table
{
    public function _initializeSchema(TableSchemaInterface $schema): TableSchemaInterface
    {
        $schema = parent::_initializeSchema($schema);
        
        $schema->setColumnType('data', 'serialized');
        
        return $schema;
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('cake_api_connector_dataobjects');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('parent_model')
            ->maxLength('parent_model', 128)
            ->allowEmptyString('parent_model');
        
        $validator
            ->scalar('entity')
            ->maxLength('entity', 128)
            ->allowEmptyString('entity');
        
        $validator
            ->scalar('runner')
            ->maxLength('runner', 128)
            ->allowEmptyString('runner');
        
        $validator
            ->scalar('runner_status')
            ->inList('runner_status', Dataobject::getValidStatusses());

        $validator
            ->allowEmptyString('data');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        $validator
            ->integer('deleted_by')
            ->allowEmptyString('deleted_by');

        return $validator;
    }
    
    /**
     * Find all the runnable Dataobjects and run them.
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findRunnable(Query $query, array $options = []) 
    {
        return $query->where([
            'runner IS NOT' =>NULL,
            'runner_status IN' => [Dataobject::STATUS_WAITING]
        ])->orderAsc('notbefore', true);
    }

    /**
     * Check if a dataobject can be saved (valid status)
     * @param Event $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     */
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        if (!$entity->isEditable()) {
            // only allow status field to be editable
            if (! (count($entity->getDirty()) === 2 && $entity->isDirty('runner_status')) && !isset($options['Runner'])) {
                $event->stopPropagation();
            }
        }
    }
    
    /**
     * Sets and save a status (using the runner_status field)
     * @param \CakeApiConnector\Model\Table\Dataobject $dataobject
     * @param string $status
     */
    public function setStatus(Dataobject $dataobject, string $status)
    {
        $this->patchEntity($dataobject, ['runner_status' => $status]);
        return $this->save($dataobject);
    }
    
    /**
     * Find the parent for the $dataobject. Can be anything
     * @param Dataobject $dataobject
     */
    public function getParent(Dataobject $dataobject) {
        if ($dataobject->parent_model === 'TaboolaCampaign') {
            return $this->find()->where([
                    'id'     =>  $dataobject->parent_id,
                    'entity'  =>  $dataobject->parent_model,
                ])->first();
        }        
        
        return null;
    }
}
