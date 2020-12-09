<?php
/* Template Name: Homepage */ 
get_header();
$upload_dir = wp_get_upload_dir ();
//print_r ($upload_dir);
?>

<!-- Home banner Section -->
<section class="home-banner">
    <div class="container">
    
        <div class="row py-5">
            <div class="col-12 col-md-6 position-unset position-md-relative">
            <div class="content-pos">
            <h1 class="display-5"><?php echo the_field('left_title'); ?></h1>
				<hr class="my-4">
				<p class="lead"><?php echo the_field('left_subtitle'); ?></p>
            </div>
            </div>
            <div class="col-12 col-md-6">
            <div class="banner-right-image">
                <img src="<?php echo the_field('right_image'); ?>" alt="" />
            </div>
            </div>
        </div>
       
    </div>
</section>
<!-- End Home banner Section -->

<!-- section 2 start -->
<section class="py-5" style="background-color:<?php echo the_field('section_2_background_color'); ?>">
<div class="container pt-0 py-lg-4">
<div class="row">
<div class="col-12 text-center">
<p class="lead text-center text-white m-0"><?php echo the_field('section_2_text'); ?></p>
</div>
</div>
</div>
</section>
<!-- section 2 end -->
<!--Features Section 1 -->
<section class="features-section py-5">
	<div class="container">	
		<h3 class="h1 text-center pt-4"><?php echo the_field('feature_section_title'); ?></h3>
		<p class="lead text-muted mb-1 text-center"><?php echo the_field('feature_section_description'); ?></p>	
		<hr class="my-4">
		
		

        <?php if( have_rows('online_teaching_tools') ): ?>
			    <?php while( have_rows('online_teaching_tools') ): the_row(); 
			    	$title = get_sub_field('tools_name');
			    	$description = get_sub_field('tools_description');
			        $image = get_sub_field('tools_image');
			        ?>

			  <div class="row no-gutters content-layout">
				<div class="col-md-8 left">
					<div class="card-body">
						<h3 class="mb-3 h5 "><?php echo $title; ?></h3>
						<p class="">
							<?php echo $description; ?>
						</p>
					</div>
				</div>
				<div class="col-md-4 right text-center text-md-right">
					<img class="card-img img-fluid" src="<?php echo $image;?>" alt="Online Classroom">
				</div>
			
		</div>
        <?php endwhile; ?>
			<?php endif; ?>	



	</div>
</section>
<!-- Features section end -->



<?php get_footer(); ?>