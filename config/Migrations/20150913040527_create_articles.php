<?php
use Migrations\AbstractMigration;

class CreateArticles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('articles');
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ])->addIndex(['slug']);        
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        
        $table->addColumn('feature_image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);

        // main 
        $table->addColumn('body', 'text', [
            'default' => null,
            'null' => false,
        ]);
        // temp way of storing catgories
        $table->addColumn('tags', 'text', [            
            'default' => null,
            'null' => false
        ]);
        $table->addColumn('category_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('published', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);        
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
