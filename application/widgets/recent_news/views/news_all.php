<h3><?php echo $title; ?></h3>
<ul>
	<?php if($this->news_m->getNews(array('limit' => $limit))): ?>
	<?php foreach ($this->news_m->getNews(array('limit' => $limit)) as $news): ?>
	<li>
		<h3><?php echo anchor('news/' . date('Y/m') . '/'. strtolower($news->slug), $news->title); ?></h3>
		<p class="article_info">Posted in category : <?php echo anchor('news/category/'.$news->category_slug, $news->category_title);?></p>
		<?php if($intro == 'true'): ?>
		<p class="article_intro"><?php echo strip_tags($news->intro); ?></p>
		<?php endif; ?>
	</li>
	<?php endforeach; ?>
	<?php else: ?>
	<li>No articles have been posted yet.</li>
	<?php endif; ?>
</ul>