<!DOCTYPE html>
<html>

	<head>    
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		
		<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/settings.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/owl.theme.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/uniform.default.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/css/theme.default.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_template_directory_uri(); ?>/style.css?v=6" rel="stylesheet" media="screen">

		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.themepunch.plugins.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.themepunch.revolution.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/revo-slider-init.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.appear.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jqury.countTo.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/moment.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.uniform.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.tablesorter.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.slimscroll.js"></script>
		<!--<script src="http://essaycoffee.disquscdn.com/embed.js"></script>
		<script src="http://essaycoffee.disqus.com/count.js"></script>-->
		<script src="<?php echo get_template_directory_uri(); ?>/js/theme_scripts.js"></script>

		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php wp_head(); ?>
	</head>

	<body>
		<div class="wrap">
		<section id="pre-header">
			<div class="container">
		        <div class="row">
		            <!-- BEGIN TOP BAR LEFT PART -->
		            <div class="col-md-6 col-sm-6 additional-info">
		                <ul>
		                    <li><i class="fa fa-phone"></i><span><?php the_field('phone_number',18); ?></span></li>
		                    <li><i class="fa fa-envelope-o"></i><span><?php the_field('email',18); ?></span></li>
		                </ul>
		            </div>
		            <!-- END TOP BAR LEFT PART -->
		            <!-- BEGIN TOP BAR MENU -->
		            <div class="col-md-6 col-sm-6 additional-nav">
		                <ul class="pull-right">
		                    <li><a href="<?php the_field('log_in_url',18); ?>">Log In</a></li>
		                    <li><a href="<?php the_field('registration_url',18); ?>">Registration</a></li>
		                </ul>
		            </div>
		            <!-- END TOP BAR MENU -->
		        </div>
		    </div>        
		</section><!--pre-header-->


	  	<header id="header">
	  		<div class="container">
  			 	<div id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/demo/logo.png"></a></div>

  			 	<a href="javascript:void(0);" class="mobi-toggler"></a>

  			 	<!-- BEGIN NAVIGATION -->

  			 	<?php $args = array(
  			 			'container' => 'div',
  			 			'container_class' => 'pull-right',
  			 			'container_id'    => 'main-navigation',
  			 	);?>

  			 	<?php wp_nav_menu( $args ); ?>
  			 	<!-- END NAVIGATION -->

  			 	<div style="clear:both"></div>
	  		</div>
	  	</header><!--header-->


	  	<main id="main">
			<div class="container">		

				<!-- BEGIN CONTENT -->
				<div class="row">
