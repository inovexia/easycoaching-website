<?php get_header(); 
$id = get_the_ID();
setup_postdata($id);
?>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9 mb-5">
                <?php get_template_part( 'template/parts/content-resource'); ?>
            </div>
    	    <div id="sidebar-right" class="col-md-3 mb-5">
				<?php dynamic_sidebar('sidebar-right'); ?>
			</div>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>