    </main>

    <footer class="page-footer pt-0">
		<div class="bg-dark py-5">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3 text-md-left text-center text-white pl-0 pl-md-3 pl-lg-4">
						<?php dynamic_sidebar( 'footer-widget-1' ); ?>
					</div>
					<div class="col-md-6 col-lg-3 text-md-left text-center text-white footer-quick-links">
						<?php dynamic_sidebar( 'footer-widget-2' ); ?>
					</div>
					<div class="col-md-6 col-lg-3 text-md-left text-center text-white">
						<?php dynamic_sidebar( 'footer-widget-3' ); ?>
					</div>
					<div class="col-md-6 col-lg-3 text-md-left text-center text-white">
						<?php dynamic_sidebar( 'footer-widget-4' ); ?>
					</div>
				</div>
			</div>
			<?php do_action('upper_footer'); ?>
		</div>

		<div id="bottom-footer" class="bg-dark py-2">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-white text-center pt-4" >
						<?php dynamic_sidebar( 'copyright' ); ?>  
					</div>         
				</div>
			</div>
		</div>
	</footer>
<?php do_action('before_footer'); ?>
<?php wp_footer(); ?>
</body>
</html>