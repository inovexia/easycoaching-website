<?php
/* Template Name: Cart */ 
get_header();
?>

<section id="main-section" class="py-5">
	<div class="content">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-9 mb-5">
					<div id="cart" class="card card-default paper-shadow">
					    <div class="card-body p-0">
						<table id="cart-table" class="table mb-0">			
						    <thead>
						        <tr>
						            <th class="border-0" width="80%">Plan Details</th>
						            <th class="border-0">Price</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
						</table>
					    </div>
						<div class="card-footer">
							<a href="<?php echo home_url('exams'); ?>" class="btn btn-default float-right continue-shop">Continue Shopping <i class="fa fa-cart-arrow-down"></i></a>
						</div>
					</div>
				</div>
				<div class="col-md-3 mb-5">
                    <div class="card card-default shadow-sm p-4">
                        <?php dynamic_sidebar('sidebar-right'); ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>