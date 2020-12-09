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
		<h3 class="text-center pt-4"><?php echo the_field('feature_section_title'); ?></h3>
		<p class="lead text-muted mb-1 text-center"><?php echo the_field('feature_section_description'); ?></p>	
		<hr class="my-4">
		
		

        <?php if( have_rows('online_teaching_tools') ): ?>
			    <?php while( have_rows('online_teaching_tools') ): the_row(); 
			    	$title = get_sub_field('tools_name');
			    	$description = get_sub_field('tools_description');
			        $image = get_sub_field('tools_image');
			        ?>

			  <div class="row no-gutters content-layout py-3">
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
	<div class="container">
	 <div class="row mb-2 justify-content-center text-center py-5" >
	   <div class="col-md-12 " >
		 <h3 class="mb-3 mb-lg-5"><?php echo the_field('more_feature_title'); ?></h3>
		 <a href="<?php echo the_field('more_feature_button_link'); ?>" class="btn btn-primary btn-lg "><?php echo the_field('more_feature_button_text'); ?></a>
	   </div>
	 </div>
	</div>
</section>

<!-- Features section end -->
<!-- Client Say section start -->
<section class="py-5 bg-light-alt" style="background-color:#f1f1f1">
	<div class="container">
		<h3 class="text-center"><?php echo the_field('testimonial_section_title'); ?></h3>
		<div class="row py-4 mb-2 justify-content-center" >
		<?php if( have_rows('our_clients') ): ?>
			    <?php while( have_rows('our_clients') ): the_row(); 
			    	$name = get_sub_field('client_name');
			    	$say = get_sub_field('client_say');
			        $image = get_sub_field('client_logo');
			        ?>
		  <div class="col-12 col-md-6 mx-auto" >
			<div class="card">
			  <div class="card-body">
			    <blockquote class="blockquote text-center">
					<?php echo $say; ?>
				    <footer class="blockquote-footer"><cite title="Source Title"><?php echo $name; ?></cite></footer>
				</blockquote>
			  </div>
			</div>
			
		  </div>
		  <?php endwhile; ?>
			<?php endif; ?>	
				
		</div>		
	</div>
</section>
<!-- Client Say section end -->


<section class="bg-white py-5 " >
	<div class="container">
	 <div class="row mb-2 justify-content-center text-center py-5" >
	   <div class="col-md-12 " >
		 <h3 class="pb-5"><?php echo the_field('cta_section_title'); ?></h3>
		 <a href="<?php echo the_field('cta_button_1_link'); ?>" class="btn btn-outline-primary btn-lg ml-2"><?php echo the_field('cta_button_1_text') ?></a>
		 <a href="<?php echo $upload_dir['baseurl'] . '/easylms/easylmsbrochure.pdf'; ?>" class="btn btn-outline-primary btn-lg ml-2" target="_blank"><?php echo the_field('cta_button_2_text') ?></a>
	   </div>
	 </div>
	</div>
</section>




<div class="container">
    <h1>Play YouTube or Vimeo Videos in Bootstrap 4 Modal</h1>
  
  
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/Jfrjeg26Cwk" data-target="#myModal">
  Play Video 1 - autoplay
</button>
  
   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/IP7uGKgJL8U" data-target="#myModal">
  Play Video 2
</button>
  
  
   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/A-twOC3W558" data-target="#myModal">
  Play Video 3
</button>
  
  
     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://player.vimeo.com/video/58385453?badge=0" data-target="#myModal">
  Play Vimeo Video
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      
      <div class="modal-body">

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
</div>
        
        
      </div>

    </div>
  </div>
</div> 
  
  
  
</div>






<?php get_footer(); ?>