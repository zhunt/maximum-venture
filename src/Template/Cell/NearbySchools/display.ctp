<?php if ($chainSchools) :?>
<p>
<aside>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Other <?php echo $chainName ?> Locations</h3>
	</div>
	<div class="panel-body">
	    <ul class="list-unstyled fa-ul extrapadding">
	    	<?php foreach( $chainSchools as $school ):  ?>
	    	<li><a href="/school/<?= $school->slug ?>"><i class="fa-li fa fa-caret-right"></i><?= h($school->city->name) ?></a></li>
	    	<?php endforeach ?>
	        
	    </ul>
	</div>
</div>
</aside>
</p>
<?php endif; ?>



<?php if ( $relatedSchools->count() > 0 ) :?>
<p>
<aside>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>More Bartending Schools</h3>
	</div>
	<div class="panel-body">
	    <ul class="list-unstyled fa-ul extrapadding">
	    	<?php foreach( $relatedSchools as $school ):  ?>
	    	<li><a href="/school/<?= $school->slug ?>"><i class="fa-li fa fa-caret-right"></i><?= h($school->name) ?></a></li>
	    	<?php endforeach ?>
	        
	    </ul>
	</div>
</div>
</aside>
</p>
<?php endif; ?>

