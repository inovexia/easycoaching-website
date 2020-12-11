<?php
/* Template Name: Pricing */ 
get_header();
?>
<section class="pricing-table py-5">
            <div class="container">
                <div class="block-heading pb-3">
               
                  <h3 class="w-100 text-center"><?php echo the_field('price_section_title'); ?></h3>
                  <p class="w-100 text-center"><?php echo the_field('price_section_subtitle'); ?></p>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-md-5 col-lg-4">
                        <div class="item">
                        <div class="ribbon" style="background:<?php echo the_field('starter_ribbon_color'); ?>"><?php echo the_field('starter_plan_ribbon') ?></div>
                            <div class="heading">
                                <h3><?php echo the_field('starter_plan_title'); ?></h3>
                            </div>
                            <p class="border-bottom pb-3"><?php echo the_field('starter_plan_description'); ?></p>
                            <div class="features">
                            <?php 
                                $rows = get_field('starter_features');
                                if( $rows ) {
                                    foreach( $rows as $row ) {
                                        $name = $row['feature_name'];
                                        echo '<p>';
                                           echo $name;
                                        echo '</p>';
                                    }
                                   
                                }
                                ?>
                                
                            </div>
                            <div class="price">
                                <h4 class="p-0 m-0"><?php echo the_field('starter_plan_price') ?></h4>
                            </div>
                            <a href="/contact-us" class="btn btn-block btn-outline-primary" type="submit">Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="item">
                        <div class="ribbon" style="background:<?php echo the_field('pro_ribbon_color'); ?>"><?php echo the_field('pro_plan_ribbon') ?></div>
                            <div class="heading">
                                <h3><?php echo the_field('pro_plan_title'); ?></h3>
                            </div>
                            <p class="border-bottom pb-3"><?php echo the_field('pro_plan_description'); ?></p>
                            <div class="features">
                            <?php 
                                $rows = get_field('pro_features');
                                if( $rows ) {
                                    foreach( $rows as $row ) {
                                        $name = $row['feature_name'];
                                        echo '<p>';
                                           echo $name;
                                        echo '</p>';
                                    }
                                   
                                }
                                ?>
                                
                            </div>
                            <div class="price">
                                <h4 class="p-0 m-0"><?php echo the_field('pro_plan_price') ?></h4>
                            </div>
                            <a href="/contact-us" class="btn btn-block btn-outline-primary" type="submit">Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="item">
                        <div class="ribbon" style="background:<?php echo the_field('enterprise_ribbon_color'); ?>"><?php echo the_field('enterprise_plan_ribbon') ?></div>
                            <div class="heading">
                                <h3><?php echo the_field('enterprise_plan_title'); ?></h3>
                            </div>
                            <p class="border-bottom pb-3"><?php echo the_field('enterprise_plan_description'); ?></p>
                            <div class="features">
                            <?php 
                                $rows = get_field('enterprise_features');
                                if( $rows ) {
                                    foreach( $rows as $row ) {
                                        $name = $row['feature_name'];
                                        echo '<p>';
                                           echo $name;
                                        echo '</p>';
                                    }
                                   
                                }
                                ?>
                                
                            </div>
                            <div class="price">
                                <h4 class="p-0 m-0"><?php echo the_field('enterprise_plan_price') ?></h4>
                            </div>
                            <a href="/contact-us" class="btn btn-block btn-outline-default btn-rounded waves-effect" type="submit">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<section class="bg-light mb-2 request-demo py-5">
    <div class="container">
	 <div class="row justify-content-center " >
	   <div class="col-12 col-md-8 col-lg-6 mx-auto" >
		 <h3 class="text-center">For more details and demo </h3>
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

<section class="py-5 " >
	<div class="container">
	 <div class="row mb-2 justify-content-center text-center py-5" >
	   <div class="col-md-12 " >
		 <h3 class="h3">CALL US (+91) 95111-18893, 95111-18894 </h3>
		 <h3 class="" style="font-size:1.30rem">EMAIL sales@easycoachingapp.com </h3>
		 
	   </div>
	 </div>
	</div>
</section>



<?php get_footer(); ?>