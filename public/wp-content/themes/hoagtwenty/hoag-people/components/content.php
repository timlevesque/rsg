<?php 
use HoagPeople\TemplateTags as Tags;

 if ( !empty($post->post_content ) || Tags\has_video() ) :  ?>
				<?php Tags\the_video(); ?>
        <?php endif; ?>
        <?php if(!empty(get_the_content())):?>
        <h3 class="h4 pt-4">About <?php the_title(); ?></h3>
        <?php endif; ?>
        <?php the_content();?>