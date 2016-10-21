<?php
namespace App\Model\Table;

use App\Model\Entity\School;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Schools Model
 */
class SchoolsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('schools');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        /*
        $this->belongsTo('Logos', [
            'foreignKey' => 'logo_id',
            'joinType' => 'INNER'
        ]);
        */

        $this->belongsTo('ImageUploads', [
            'foreignKey' => 'logo_id',
            //'joinType' => 'INNER'
        ]);

        $this->belongsTo('Chains', [
            'foreignKey' => 'chain_id'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
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
            ->notEmpty('name');

        $validator->add('slug', 'not-blank', ['rule' => 'notBlank']);   

        $validator
            ->allowEmpty('seo_title');          
            
        $validator
            ->allowEmpty('address');
            
        $validator
            ->allowEmpty('phone_1');
            
        $validator
            ->allowEmpty('phone_2');
            
        $validator
            ->allowEmpty('website_1_url');
            
        $validator
            ->allowEmpty('website_2_url');
            
        $validator
            ->allowEmpty('description'); 
            
        $validator
            ->add('geo_latt', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('geo_latt');
            
        $validator
            ->add('geo_long', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('geo_long');

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
        //$rules->add($rules->existsIn(['logo_id'], 'Logos'));
        //$rules->add($rules->existsIn(['logo_id'], 'ImageUploads'));
        //$rules->add($rules->existsIn(['chain_id'], 'Chains'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        return $rules;
    }
}
