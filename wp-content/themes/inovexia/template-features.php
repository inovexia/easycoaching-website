<?php
/* Template Name: Features */ 
get_header();
?>
<section class="bg-white py-5">
	<div class="container">
		<h3 class="h1 text-center"><?php the_field('features_section_title'); ?></h3>
		<p class="lead text-muted mb-1 text-center"><?php the_field('features_section_subtitle'); ?></p>
		
		<div class="separator mb-4"></div>
	
		<div class="row mb-2 px-4 mt-5  align-item-center">
			<?php if( have_rows('app_features') ): ?>
			    <?php while( have_rows('app_features') ): the_row(); 
			    	$title = get_sub_field('title');
			    	$description = get_sub_field('description');
			        $image = get_sub_field('icon');
			        ?>
			        
			        <div class="col-12 col-md-6 col-lg-4 text-center mb-3" >
						<div class="feature-icon">
							 <img src="<?php echo $image; ?>" width="60" height="60" />
						</div>
						<div class="media-body ml-2">
							<h3 class="py-3" style=""><?php echo $title; ?></h3>
							<p class="mt-2" >
								<?php echo $description; ?>
							</p>
						</div>
					</div>
			    <?php endwhile; ?>
			<?php endif; ?>	
    			
		</div>	
	</div>
</section>


<section class="py-5 page-section" >
	<div class="container">
	 <h3 class="h1 text-center text-blue-800 text-center"><?php the_field('package_section_title'); ?></h3>
	 <p class="text-center col-12 col-md-10 col-lg-8 mx-auto"><?php the_field('package_section_subtitle'); ?></p>
	 
	 <div class="row mt-5 mb-2 justify-content-center" >
	 	<?php if( have_rows('ready_tests_packages') ): ?>
			    <?php while( have_rows('ready_tests_packages') ): the_row(); 
			    	$test_name = get_sub_field('test_name');
			    	$total_tests = get_sub_field('total_tests');
			        $test_price = get_sub_field('test_price');
			        ?>
			        
			        <div class="col-md-3">
						<div class="card shadow-sm mb-3">
							<div class="card-body text-center">
								<h4><?php echo $test_name; ?></h4>
								<div class="d-flex justify-content-between">
									<span><?php echo $total_tests; ?> Tests</span>
									<span>Price: <i class="fa fa-rupee-sign"></i> <?php echo $test_price; ?></span> 
								</div>
							</div>
						</div>
					</div>
			    <?php endwhile; ?>
			<?php endif; ?>	
		
	 </div>
	 
	 <p class="text-center lead">And More...</p>
	</div>
</section>

<section class="bg-white py-5 " >
	<div class="container">
	 <div class="row mb-2 justify-content-center text-center py-5" >
	   <div class="col-md-12 " >
       <h3 class="pb-5"><?php echo the_field('demo_section_title','option'); ?></h3>
		 <a href="<?php echo the_field('demo_button_1_link','option'); ?>" class="btn btn-outline-default btn-rounded waves-effect"><?php echo the_field('demo_button_1_text','option') ?></a>
		 <a href="<?php echo the_field('demo_button_2_link','option'); ?>" class="btn btn-outline-default btn-rounded waves-effect" target="_blank"><?php echo the_field('demo_button_2_text','option') ?></a>
         </div>
	 </div>
	</div>
</section>

<?php get_footer(); ?>