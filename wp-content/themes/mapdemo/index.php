<html>
	<head>
		<title>Maps Test</title>
                <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
                <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/map.js"></script>
		<?php wp_head(); ?>
	</head>
 
	<body onload="initialize()">
                <?php if ( have_posts() ) : ?>
	            <!-- WordPress has found matching posts -->
                    <div id="map" style="width: 100%; height: 100%;"></div>
                <?php else : ?>
	            <!-- No matching posts, show an error -->
	            <h1>Error 404 &mdash; Page not found.</h1>
                <?php endif; ?>
		<?php wp_footer(); ?>
	</body>
</html>
