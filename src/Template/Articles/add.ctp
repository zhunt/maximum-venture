<?php use Cake\Core\Configure; ?>
<?php $this->assign('title', 'Submit News Story to ' . Configure::read('websiteName') ); ?>

    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->


    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Submit News Story</h1>
            <ul class="pull-right breadcrumb">
               
                <li class="active">Submit News Story</li>
            </ul>
        </div>
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">








                <!-- Order Form -->
                <h3 class="text-center"><?= $this->Flash->render() ?></h3>
                <?= $this->Form->create($article, ['class' => 'sky-form', 'id' => 'submitNews' ]) ?>
               
                    <header>Submit Your Business News Story</header>

                    <fieldset>
                    <section>
                        <label for="title" class="input input-file">Story Title 
                  
                                                       
                            <?= $this->Form->input('name', ['label' => false, 'div' => false, 'maxlength' => 80,  'required' => false,
                                'placeholder' => '6-10 words is the magic headline range! (Maximum of 54 characters)'  ]); ?>
                        </label>
                    </section>

                    <section>
                        <label for="newsstory" class="textarea">Your Scoop
                            

                            <?= $this->Form->input('body', ['label' => false, 'div' => false,
                                'wrap' => 'virtual', 'rows' => 5, 'cols' => 50, 'required' => false,
                                'placeholder' => "Put the main body of your story submission here: reader submissions are what make " . Configure::read('websiteName') . " work. Please try to use your own words; if you're quoting another source, make that clear. Include URLs as appropriate, and try to include original sources and background material Most stories on " . Configure::read('websiteName') . " are less than 120 words; brevity is the soul of wit."
                                ]); ?>

                        </label>
                    </section> 

                    <section>
                        <label for="url" class="input">URL<span> (If not in the story)</span>
                            <!-- <input type="text" name="feature_text" placeholder="If it's not in the text of the story, please add here the single most important URL for this story"> -->
                            <?= $this->Form->input('feature_text', ['label' => false, 'div' => false, 'maxlength' => 200, 'type' => 'text',
                                'placeholder' => "If it's not in the text of the story, please add here the single most important URL for this story"  
                                ]); ?>
                        </label>
                    </section>

                    <section>
                        <label for="title" class="input input-file">Name             
                            <?= $this->Form->input('author', ['label' => false, 'div' => false, 'maxlength' => 50,  'required' => false,
                                'placeholder' => 'Your name (optional)'  ]); ?>
                        </label>
                    </section>
                    <section>
                        <label for="title" class="input input-file">Website             
                            <?= $this->Form->input('author_url', ['label' => false, 'div' => false, 'maxlength' => 255,  'required' => false,
                                'placeholder' => 'Your website (optional)'  ]); ?>
                        </label>
                    </section>                    


                    </fieldset>

                    <section class="text-center" style="margin: 10px auto; width: 305px;">
                        <input type="hidden" name="confirm_captcha" value="123" />
                        <label for="capcha" class="input">google recaptcha
                            <div class="g-recaptcha text-center" data-callback="showStorySubmitButton" data-sitekey="<?php echo Configure::read('googleSiteKey');?>"></div>
                        </label>
                    </section>

                    <footer>
                        <button type="submit" id="submitStoryBtn" class="btn-u">Send</button>
                        <div class="progress"></div>
                    </footer>               
                    <div class="message">
                        <i class="rounded-x fa fa-check"></i>
                        <p>Thanks for your order!<br>We'll contact you very soon.</p>
                    </div>
                </form> 



                <!-- End Order Form -->
            </div>



<?php $this->Html->script('https://www.google.com/recaptcha/api.js', ['block' => true]); ?>
<?php $this->Html->script('/assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js', ['block' => true]); ?>

<?php //$this->Html->script('http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.js', ['block' => true]); ?>

<?php $this->Html->script('/js/main.js', ['block' => true]); ?>

<?php // $this->Html->css('/css/select2.min.css', ['block' => true]); ?>


<!-- script src="/assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script -->
<script>


</script>            