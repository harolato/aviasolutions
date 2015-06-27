<?php
namespace App\Model\Table;

use App\Model\Entity\Employee;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 */
class EmployeesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('employees');
        $this->displayField('name');
        $this->primaryKey('id');
        // Darbuotojas priklauso kompanijai
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name','Name is required');
            
        $validator
            ->requirePresence('surname', 'create')
            ->notEmpty('surname','Surname is required');
            
        $validator
            ->add('email', 'valid', ['rule' => 'email','message' => "Invalid email address"])
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'Email is required');
            
        $validator
            ->add('employment_date', 'valid', ['rule' => 'date'])
            ->requirePresence('employment_date', 'create')
            ->notEmpty('employment_date', 'Please specify employment date');

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
        // Patikriname ar įvestas elektroninio pašto adersas nesikartoja duomenų bazėje.
        $rules->add($rules->isUnique(['email'],"Email address already exist in our database."));
        // Patikriname ar pasirinkta kompanija egzistuoja duomenų bazėje.
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        return $rules;
    }
}
