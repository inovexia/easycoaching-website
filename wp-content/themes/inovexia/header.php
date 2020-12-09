<!doctype html>
<html class="" lang="en" dir="ltr"> 
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="LMSMadeEasy is a learning management software for online teaching">
	<meta name="keywords" content="Learning Management Software, Online Lessons, Online Teaching, Test Builder">
	<?php wp_head(); ?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180715341-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	functiongtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-180715341-1');
	</script>

</head>

<body id="app-container" class="<?php body_class(); ?> vertical boxed ltr rounded menu-default main-hidden sub-hidden ">

	<nav class="navbar navbar-expand-md px-3 px-md-4 px-lg-5 bg-white">
		<div class="container">
			<?php 
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			
				if (has_custom_logo()) {
					?>
					<?php
					echo '<a href="'.site_url().'" class="navbar-logo navbar-brand">
						<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" width="84" height="30">
					</a>';
				} else {
					echo '<a href="'.site_url().'"><span>'. get_bloginfo( 'name' ) .'</span></a>';
				}
			?>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<div class="navbar-collapse bg-transparent pt-md-0 p-3 p-md-0 collapse" id="main-menu" style="z-index:99;">
				<?php wp_nav_menu( array(
				'theme_location' => 'Main Menu', 
				'container' => 'ul', 
				'menu_class' => 'navbar-nav mr-auto cs1-text-secondary', 
				'menu_id' => false, 
				'link_class'=> 'nav-item ', 
				'walker' => new learningAppWalker()
				)); 
				?>
				<span class="navbar-text">
					
					<a href="https://apexcoachings.com/login-register/" class="apex-default-btn">
					    <i class="fa fa-user"></i> Sign-In<span style=""></span> 
					</a>
				</span>
			</div>
		</div>
	</nav>
	
	
	<main class="default-transition">
		<?php
		if( !is_front_page()&& !is_404()) {
			if(is_page('pricing-coaching')){
				$icon = "iconsminds-pricing";
			}else if(is_page('features')){
				$icon = "simple-icon-trophy";
			}else if(is_page('faq')){
				$icon = "simple-icon-question";
			}else if(is_page('cart')){
				$icon = "fa fa-shopping-cart";
			}else if(is_page('quizzes')||is_page('start-quiz')){
				$icon = "fa fa-question-circle";
			}else if(is_page('exams')||is_singular('plan')||is_tax('exams')||is_singular('exams-detail')){
				$icon = "fa fa-graduation-cap";
			}else if(is_singular('resource')){
				$icon = get_field('icon');
			}else if(is_page('blogs')||is_single()){
				$icon = "fa fa-blog";
			}else if(is_page('contact-us')){
				$icon = "simple-icon-phone";
			}else if(is_404()){
				$icon = "fas fa-exclamation";
			}else{
				$icon = "fa fa-file";
			}
			
			if(is_singular('plan')){
				$terms = get_the_terms(get_the_ID(), "exams");
				$pageTitle = "Exam Plan";
			}else if(is_tax('exams')&&taxonomy_exists('exams')){
				$taxonomyName = get_queried_object()->name;
				$pageTitle = $taxonomyName. " Exam";
			}else if(is_singular('exams-detail')){
				$pageTitle = get_the_title() . " Details";
			}else if(is_singular('resource')){
				$pageTitle = get_the_title();
			}else if(is_single()){
				$pageTitle = "Blogs";
			}else if(is_404()){
				$pageTitle = "Page not found";
			}else{
				$pageTitle = get_the_title();
			}
			?>
				<div class="row bg-primary">
					<div class="col-12">
						<div class="container">
							<div class="py-3 m-0">
								<h1 class="text-white p-0 m-0"><i class="<?php echo $icon; ?> mr-3"></i> <?php echo $pageTitle; ?></h1>
							</div>
						</div>
					</div>
				</div>
			<?php 
		} 
		?>
