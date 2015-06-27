<?php
namespace App\Model\Table;

use App\Model\Entity\Company;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \Cake\ORM\Association\HasMany $Employees
 */
class CompaniesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        // Priskiriame duomenų bazės lentelę
        $this->table('companies');
        // Pasirūpiname, kad vartotojam nerodytu id, o tik name laukelį formose
        $this->displayField('name');
        // pirminis raktas
        $this->primaryKey('id');
        // Nustatome asociaciją su Darbuotojų lentele
        // Kompanija turi daug darbuotojų
        $this->hasMany('Employees', [
            'foreignKey' => 'company_id'
        ]);
    }

    /**
     * Default validation rules.
     * @desc Paprastos įvesties laukelių tikrinimo taisyklės
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        // Tikrinam ar ID tikrai yra skaičius ir ar nėra tuščias
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
        // Tikrinam ar vardas yra įvestas
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name', 'Name missing');
        // Tikrinam ar adresas yra įvestas
        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address', 'Address missing');
        // Patikriname ar elektroninio pašto adresas yra teisingas
        $validator
            ->add('email', 'valid', ['rule' => 'email','message' => 'Email address is incorrect'])
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'Email missing');
            
        $validator
            ->requirePresence('phone_no', 'create')
            ->notEmpty('phone_no', 'Phone number missing');

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
        $rules->add($rules->isUnique(['email'],"Company email address already exist in our database."));
        $rules->add($rules->isUnique(['name'],"Company name already exist in our database."));
        return $rules;
    }
}
