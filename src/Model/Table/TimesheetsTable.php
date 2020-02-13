<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Timesheets Model
 *
 * @property \App\Model\Table\EmployeesTable&\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\AssociatedsTable&\Cake\ORM\Association\BelongsTo $Associateds
 *
 * @method \App\Model\Entity\Timesheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timesheet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Timesheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timesheet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timesheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timesheet findOrCreate($search, callable $callback = null, $options = [])
 */
class TimesheetsTable extends Table
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

        $this->setTable('timesheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Associateds', [
            'foreignKey' => 'associated_id',
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
            ->scalar('job_number')
            ->maxLength('job_number', 255)
            ->requirePresence('job_number', 'create')
            ->notEmptyString('job_number');

        $validator
            ->boolean('monday')
            ->allowEmptyString('monday');

        $validator
            ->boolean('tuesday')
            ->allowEmptyString('tuesday');

        $validator
            ->boolean('wednesday')
            ->allowEmptyString('wednesday');

        $validator
            ->boolean('thursday')
            ->allowEmptyString('thursday');

        $validator
            ->boolean('friday')
            ->allowEmptyString('friday');

        $validator
            ->boolean('saturday')
            ->allowEmptyString('saturday');

        $validator
            ->boolean('sunday')
            ->allowEmptyString('sunday');

        $validator
            ->dateTime('date_created')
            ->notEmptyDateTime('date_created');

        $validator
            ->dateTime('date_modified')
            ->allowEmptyDateTime('date_modified');

        $validator
            ->date('for_date')
            ->allowEmptyDate('for_date');

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
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        return $rules;
    }
}
