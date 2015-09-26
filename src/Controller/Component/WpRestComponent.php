<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Cake\Network\Http\Client;

/**
 * WpRest component
 */
class WpRestComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    // read from wordpress blog, return array sutable to saving into db
    public function getRecentPosts( $numPosts = 5) {
    	//debug($numPosts);

    	$http = new Client();
    	$response = $http->get('http://127.0.0.1:8087/wp-json/posts?filter[orderby]=date&filter[order]=desc&filter[posts_per_page]=' . $numPosts );

    	$json = $response->json;

    	//debug($json);

    	$data = [];
    	foreach( $json as $i => $result ) {
    		//debug($result['featured_image']['attachment_meta']['sizes']['medium']['url']); //exit;
    		$data[$i] = [
    			'id' => $result['ID'], 
    			'name' => $result['title'],
    			'slug' => $result['slug'],
    			'date' => $result['date'],
    			'feature_image' => $result['featured_image']['attachment_meta']['sizes']['medium']['url'], // ['sizes']['medium'], // also 'source', 'thumbnail' 
    			'body' => $result['content'],
    			
    			];

    		$tags = $this->extractTerms( $result['terms']['post_tag']);		
    		//debug($tags);

    		$categories = $this->extractTerms( $result['terms']['category']);	
    		//debug($categories);

    		$data[$i]['tags'] = $tags;
    		$data[$i]['categories'] = $categories;

    		
    	}
//exit;
    	//debug($data);
    	return $data;

    }

    // pull out any terms from array
    private function extractTerms( $terms) {
    	if ( isset($terms) && !empty($terms)) {
    		$data = [];
    		foreach ($terms as $i => $result) {
    			$data[ $result['slug'] ] = (string)$result['name'];
    		} debug($data);
    		return $data;
    	}

    }
}
