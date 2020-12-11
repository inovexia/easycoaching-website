    </main>

    <footer class="page-footer pt-0">
		<div class="py-5" style="background-color:#100f1f">
			<div class="container">
				<div class="row">
				<div class="col-12 col-md-6 col-lg-3 text-left text-white">
						<?php dynamic_sidebar( 'footer-widget-1' ); ?>
					</div>
					<div class="col-12 col-md-6 col-lg-3 text-left text-white">
						<?php dynamic_sidebar( 'footer-widget-2' ); ?>
					</div>
					<div class="col-12 col-md-6 col-lg-3 text-left text-white">
						<?php dynamic_sidebar( 'footer-widget-3' ); ?>
					</div>
					<div class="col-12 col-md-6 col-lg-3 text-left text-white">
						<?php dynamic_sidebar( 'footer-widget-4' ); ?>
					</div>
					
				</div>
			</div>
			<?php do_action('upper_footer'); ?>
		</div>

		<div id="bottom-footer" class="py-2" style="background-color:#100f1f; border-top:1px solid rgba(255,255,255,0.1);">
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