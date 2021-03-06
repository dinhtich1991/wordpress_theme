<?php get_header(); ?>
<div class="content">
	<div class="main-content">
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<h1><?php get_template_part('content', get_post_format()); ?></h1>
			<?php get_template_part('author-bio'); ?>
			<?php comments_template(); ?>
			<?php endwhile; ?>
		<?php else: ?>
			<?php get_template_part('content', 'none') ?>
		<?php endif; ?>
	</div>
	<div class="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>




<?php get_footer(); ?>