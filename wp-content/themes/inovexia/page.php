<?php get_header();?>
<?php while ( have_posts() ) :    
    the_post();?>
    <div class="content">
        <div class="container">
            <div class="row"> 
                <div class="col-md-12 mt-5">
                    <?php the_content();?> 
                </div>
            </div>    
        </div>
    </div>
<?php endwhile;?>
<?php get_footer(); ?>