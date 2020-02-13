<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Expenses Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Expense get($primaryKey, $options = [])
 * @method \App\Model\Entity\Expense newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Expense[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Expense|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expense saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Expense patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Expense[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Expense findOrCreate($search, callable $callback = null, $options = [])
 */
class ExpensesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('expenses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('item_name')
            ->maxLength('item_name', 255)
            ->requirePresence('item_name', 'create')
            ->notEmptyString('item_name');

        $validator
            ->scalar('taxable')
            ->maxLength('taxable', 50)
            ->requirePresence('taxable', 'create')
            ->notEmptyString('taxable');

        $validator
            ->decimal('item_cost')
            ->requirePresence('item_cost', 'create')
            ->notEmptyString('item_cost');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->dateTime('item_date')
            ->requirePresence('item_date', 'create')
            ->notEmptyDateTime('item_date');

        $validator
            ->dateTime('date_modified')
            ->allowEmptyDateTime('date_modified');

        $validator
            ->dateTime('date_added')
            ->allowEmptyDateTime('date_added');

        $validator
            ->scalar('purchase_state')
            ->maxLength('purchase_state', 10)
            ->allowEmptyString('purchase_state');

        $validator
            ->scalar('cat_name')
            ->maxLength('cat_name', 255)
            ->allowEmptyString('cat_name');

        $validator
            ->scalar('job_number')
            ->maxLength('job_number', 255)
            ->requirePresence('job_number', 'create')
            ->notEmptyString('job_number');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    public function showExpenses($id){
        $previousExpenses = $this->query()
            ->find('all')
            ->where(['user_id' => $id])
            ->order(['item_date' => 'DESC']);
        return $previousExpenses;
    }
    
    public function deleteRecord($id){
        $entity = $this->get($id);
        if($this->delete($entity)){
            return true;
        }
        return false;
    }
}
