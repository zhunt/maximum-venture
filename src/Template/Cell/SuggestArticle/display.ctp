<style>
ul.suggestArticles {
list-style-type: square;
    list-style-position: inside;
    text-align: center;
    margin-left: 0;
    padding-left: 0;	
}

.suggestArticles a {
overflow: hidden;
    display: block;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
<hr>
<h3 class="text-center">Read More:</h3>
	<?php
	echo '<ul class="text-center suggestArticles">';
	foreach ($suggestedArticles as $row) {
		echo '<li><a href="/article/' . $row['slug'] . '">' . $row['seo_title'] . '</a></li>';
	}
?>
<hr>
