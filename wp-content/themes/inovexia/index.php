<?php get_header(); ?><div class="bg-dark py-4">    <div class="container">        <div class="row">            <div class="col-md-12">            	<?php the_title('<h2 class="text-display-1 text-white">',"<h2>");?>            </div>        </div>    </div></div><div class="content">    <div class="container">        <div class="row">            <div class="col-md-12 mb-5">            	<?php the_content();?>            </div>        </div>    </div></div><?php get_footer(); ?>