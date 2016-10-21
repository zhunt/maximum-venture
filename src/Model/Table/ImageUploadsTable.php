<?php
namespace App\Model\Table;

use App\Model\Entity\ImageUpload;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ImageUploads Model
 */
class ImageUploadsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('image_uploads');
        $this->displayField('name');
        $this->primaryKey('id');
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
        // 500000 = 500k image max
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('filename', 'file1', 
                ['rule' => ['uploadedFile', 
                    [ 'maxSize' => 500000, 'optional' => true, 'types' => ['image/jpeg', 'image/png'] ] ] 
                ])
            ->allowEmpty('filename', 'edit')
            ->requirePresence('filename', 'create')
            ->requirePresence('file_meta', 'edit')->allowEmpty('file_meta', 'create');
           // ->notEmpty('file_meta');

        return $validator;
    }
}

/*
Options
types - An array of valid mime types. If empty all types will be accepted. The type will not be looked at, instead the file type will be checked with ext/finfo.
minSize - The minimum file size in bytes. Defaults to not checking.
maxSize - The maximum file size in bytes. Defaults to not checking.
optional - Whether or not this file is optional. Defaults to false. If true a missing file will pass the validator regardless of other constraints.
*/