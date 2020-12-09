<?php
/* Template Name: Contact Us */ 
get_header();
?>
<section class="bg-light mb-2 request-demo py-5">
    <div class="container">
	 <div class="row justify-content-center " >
	   <div class="col-12 col-md-8 col-lg-6 mx-auto" >
		 <h3 class="text-center">For more details and demo</h3>
         <p class="lead text-muted mb-1 text-center">Fill up the form and send us, our sales team will get in touch very soon</p>
		 <div class="card mt-4">
		     <div class="card-body request-demo-form">
		         <?php echo do_shortcode ('[contact-form-7 id="7" title="Request A Demo Form"]'); ?>
		     </div>
		 </div>
	   </div>
	 </div>
    </div>
</section>

<?php get_footer(); ?>