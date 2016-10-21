<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Parsedown;

/**
 * Schools Controller
 *
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class SchoolsController extends AppController
{

    private $adBlock1 = '
        <div class="col-md-8 col-lg-4 pull-right-lg ab1">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- bartenderTraining-adblock1 -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-5569648086666006"
                             data-ad-slot="5270749504"
                             data-ad-format="auto"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
        </div>
        ';    

    public function beforeFilter(Event $event)
    {
       $this->Auth->allow();
    }        

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Chains', 'Cities']
        ];
        $this->set('schools', $this->paginate($this->Schools));
        $this->set('_serialize', ['schools']);
    }

    /**
     * View method
     *
     * @param string|null $id School id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); 

        $school = $this->Schools->find( 'all', [
            'conditions' => ['Schools.slug' => $slug],
            'contain' => [
                'Chains', 
                'Cities' => [ 
                    'Provinces' => [ 'fields' => [ 'id', 'name' ] ] , 
                    'fields' => [ 'name', 'slug'] ], 
                
                ]
        ])->first();

        // set the canconical link to the chain's if set
        //debug($school->chain->id);
        if ( !empty($school->chain->id) ) {
            $canonical = $school->chain->canonical_link; 
        } else {
            $canonical = Configure::read('siteUrlFull') . '/school/' . $school->slug;
        }

        $bodyText = $school->description;

        $bodyText = Parsedown::instance()->text($bodyText);

        $bodyText = str_replace('[ADBLOCK1]', $this->adBlock1 , $bodyText);

        $school->description = $bodyText;        

        $this->set('school', $school);
        $this->set('canonical', $canonical );
        $this->set('_serialize', ['school']);
    }


}
