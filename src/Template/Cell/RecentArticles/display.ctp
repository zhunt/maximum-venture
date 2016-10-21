


<p>
<aside>
<div class="panel panel-default">
	
		
	
	<div class="panel-body">
		<h3 class="text-center">More Bartending Tips</h3>	
	    <ol class="list-unstyled fa-ul extrapadding text-center">
	    	<?php foreach( $relatedArticles as $article ): //debug($article) ?>
	    	<li><strong><a href="/article/<?= $article->slug ?>"><i class="fa-li fa "></i><?= h($article->name) ?></a></strong></li>
	    	<?php endforeach ?>
	    </ol>

	    <p class="text-center"><a href="/category" class="btn">See More</a></p>
	</div>
</div>
</aside>
</p>





                            	