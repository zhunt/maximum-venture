<?php
namespace App\Model\Table;

use App\Model\Entity\Landing;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Landings Model
 */
class LandingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('landings');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('PageTypes', [
            'foreignKey' => 'page_type_id'
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
            ->requirePresence('page_name', 'create')
            ->notEmpty('page_name')
            ->requirePresence('seo_title', 'create')
            ->notEmpty('seo_title')
            ->add('seo_desc', 'valid', ['rule' => 'numeric'])
            ->requirePresence('seo_desc', 'create')
            ->notEmpty('seo_desc')
            ->add('page_type_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('page_type_id', 'create')
            ->notEmpty('page_type_id')
            ->allowEmpty('block_1_title')
            ->allowEmpty('block_1_content')
            ->allowEmpty('block_2_title')
            ->allowEmpty('block_2_content')
            ->allowEmpty('block_3_title')
            ->allowEmpty('block_3_content')
            ->allowEmpty('block_4_title')
            ->allowEmpty('block_4_content')
            ->allowEmpty('block_5_title')
            ->allowEmpty('block_5_content');

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
        $rules->add($rules->existsIn(['page_type_id'], 'PageTypes'));
        return $rules;
    }
}
