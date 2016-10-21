<?php
namespace App\Model\Table;

use App\Model\Entity\Article;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

// for trimming fields
use Cake\Event\Event;
use ArrayObject;

// for reCapcha validation
use Cake\Core\Configure;

/**
 * Articles Model
 */
class ArticlesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('articles');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        //$this->addBehavior('Muffin/Tags.Tag');
        
        $this->addBehavior('Muffin/Slug.Slug', [
            // Optionally define your custom options here (see Configuration)
          ]);        

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            //'joinType' => 'INNER'
        ]);

        $this->belongsTo('Categories2', [
            'className' => 'Categories',
            'foreignKey' => 'category_id_2',
            //'joinType' => 'INNER'
        ]);

        
        $this->belongsTo('ImageUploads', [
            'foreignKey' => 'feature_image_id'
        ]);

        $this->belongsToMany('Tags', [
            'foreignKey' => 'article_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'articles_tags'
        ]);        

    }

    // events
    // these can be user submitted, so handle different
    public function beforeMarshal(Event $event, ArrayObject $data) {
        $data['name'] = trim($data['name']);
        $data['body'] = trim($data['body']);
        $data['feature_text'] = trim($data['feature_text']);
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
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->requirePresence('slug', 'create')
            ->allowEmpty('slug', 'create')
            ->requirePresence('seo_title', 'create')
            ->notEmpty('seo_title')
            ->requirePresence('seo_desc', 'create')
            ->notEmpty('seo_desc')
            ->requirePresence('body', 'create')
            ->notEmpty('body')
            ->add('flag_html', 'valid', ['rule' => 'boolean'])
            ->requirePresence('flag_html', 'create')
            ->notEmpty('flag_html')
            ->add('flag_featured', 'valid', ['rule' => 'boolean'])
            ->requirePresence('flag_featured', 'create')
            ->notEmpty('flag_featured')
            ->allowEmpty('feature_text')
            ->allowEmpty('subhead');


        return $validator;
    }

    /*
    * Validator for user submited stories
    */
    public function validationUserStory(Validator $validator){
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->requirePresence('name', 'create')
            ->notEmpty('name', 'Please enter a title for the story')
            ->add('name', [
                    'length' => [
                        'rule' => ['lengthBetween', 10, 57],
                        'message' => 'Titles need to be between 10 and 57 characters long'
                    ]
            ])
            ->requirePresence('body', 'create')
            ->notEmpty('body', 'Please enter some text for the story' )
            ->add('body', [
                    'lengthMin' => [
                        'rule' => ['minLength', 50],
                        'message' => 'The story needs to be at least 50 characters, but not more than 5000 long'
                    ],
                    'lengthMax' => [
                        'rule' => ['maxLength', 5000],
                        'message' => 'The story needs to be less than 5000 characters'
                    ]

            ])
            ->allowEmpty('feature_text')
            ->add('feature_text', [
                    'url' => [
                        'rule' => 'url',
                        'message' => 'Please enter your url, e.g. www.MyWebsite.com'
                    ],
                    'lengthMax' => [
                        'rule' => ['maxLength', 255],
                        'message' => 'The url needs to be less than 255 characters'
                    ]
                ]
            )
            ->add('confirm_captcha',[
                'notEmptyCheck'=>[
                    'rule'=>'isGoodCaptcha',
                    'provider'=>'table',
                    'message'=>'Captcha problems'
                 ]
            ]);

        return $validator;
    }

    // custom validator 

    public function isGoodCaptcha($value,$context){

        $recaptcha = new \ReCaptcha\ReCaptcha( Configure::read('googleSecretKey') );

        $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if ($resp->isSuccess()){
            return true;
        }else {
            return false;    
        } 
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
        $rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['feature_image_id'], 'ImageUploads'));
        return $rules;
    }


    // ----
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    protected function _buildTags($tagString)
    {
        $new = array_unique(array_map('trim', explode(',', $tagString)));
        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.title IN' => $new]);

        // Remove existing tags from the list of new tags.
        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $new);
            if ($index !== false) {
                unset($new[$index]);
            }
        }
        // Add existing tags.
        foreach ($query as $tag) {
            $out[] = $tag;
        }
        // Add new tags.
        foreach ($new as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }

        return $out;
    }


    public function findTagged(Query $query, array $options)
    {
        return $this->find()
            ->select( [ 'Articles.id', 'Tags.title']) // limit to just the articleId
            ->distinct(['Articles.id'])
            ->matching('Tags', function ($q) use ($options) {
                if (empty($options['tags'])) {
                    return $q->where(['Tags.slug IS' => null]);
                }
                return $q->where(['Tags.slug IN' => $options['tags']]);
            });
    }

   

}
