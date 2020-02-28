<?php
namespace CakeApiConnector\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
    public function _initializeSchema(\Cake\Database\Schema\TableSchema $schema) {
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
    public function initialize(array $config)
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
    public function validationDefault(Validator $validator)
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
}
