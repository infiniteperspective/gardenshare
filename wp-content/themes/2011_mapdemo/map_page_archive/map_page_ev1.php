<?php
/**
 * The template for displaying map pages.
 * Template Name: map_page_ev1
 * This is the template that displays map pages.
 * Map pages are relatively static and will not issue get_header() or get_footer()
 * <script type="text/javascript"><!--initialize();//--></script>
 */
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/map.js"></script>

<body onload="initialize()">
<div id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

           		<div id="map" style="width: 70%; height: 70%;"></div>

        		<?php get_template_part( 'content', 'page' ); ?>

                	<?php comments_template( '', true ); ?>

        	<?php endwhile; // end of the loop. ?>


	</div><!-- #content -->
</div><!-- #primary -->
</body>

<?php get_footer(); ?>

