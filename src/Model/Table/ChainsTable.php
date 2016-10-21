<?php
namespace App\Model\Table;

use App\Model\Entity\Chain;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Chains Model
 */
class ChainsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('chains');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->hasMany('Schools', [
            'foreignKey' => 'chain_id'
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
            ->allowEmpty('id', 'create')
            ->requirePresence('name', 'canonical_link', 'create')
            ->notEmpty('name', 'canonical_link');

        return $validator;
    }
}
