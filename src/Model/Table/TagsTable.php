<?php
namespace App\Model\Table;

use App\Model\Entity\Tag;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tags Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Articles
 */
class TagsTable extends Table
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

        $this->table('tags');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Articles', [
            'foreignKey' => 'tag_id',
            'targetForeignKey' => 'article_id',
            'joinTable' => 'articles_tags'
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
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }


        /** Custom methods **/

    public function updateTags($tags) {
        if ( !empty($tags)){
           // debug($tags);
            $tagIds = [];
            foreach ($tags as $slug => $value) {
                $result = $this->findBySlug($slug);
                if ($result->isEmpty() ) {
                    $entity = $this->newEntity( ['name' => $value, 'slug' => $slug ] , ['validate' => false]);
                    $result = $this->save($entity);
                    $tagIds[] = $result->id;
                }
                else {
                    $result = $result->first();
                    $entity = $this->newEntity( [ 'name' => $value, 'slug' => $slug ] , ['validate' => false]);
                    $entity->id = $result->id;
                    $result = $this->save($entity);
                    $tagIds[] = $result->id;                    

                }
            }
            return $tagIds;
        } 
        else {
            return null;
        }
    }
}
