<?php
/**
 * The template for displaying map pages.
 * Template Name: map_page_ev6
 * This is the template that displays map pages.
 * We are using a custom .php file that is build from the header.php and page.php.
 * The reason for this approach is to avoid loading the JS on every page that calls
 * header.  Doctype php languages caused issues the precluded the map interface to be initiated.
 *
 */
?>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<title><?php
        /*
         * Print the <title> tag based on what is being viewed.
         */
        global $page, $paged;

        wp_title( '|', true, 'right' );

        // Add the blog name.
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
                echo " | $site_description";

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
                echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

        ?></title>

<!--Moving the Javascript into head tag for ev4-->
<!--Adding the Google Code API Key for ev6-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD81gccHBn5D0xbQMIIT3XBOLjDySe0vNc&sensor=false"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/map_ev1.js"></script>

<!--This was added for ev3-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


</head>

<body <?php body_class();?> onload="initialize()">

<div id="page" class="hfeed">
        <header id="branding" role="banner">
                        <hgroup>
                                <h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
                                <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                        </hgroup>

                        <?php
                                // Check to see if the header image has been removed
                                $header_image = get_header_image();
                                if ( $header_image ) :
                                        // Compatibility with versions of WordPress prior to 3.4.
                                        if ( function_exists( 'get_custom_header' ) ) {
                                                // We need to figure out what the minimum width should be for our featured image.
                                                // This result would be the suggested width if the theme were to implement flexible widths.
                                                $header_image_width = get_theme_support( 'custom-header', 'width' );
                                        } else {
                                                $header_image_width = HEADER_IMAGE_WIDTH;
                                        }
                                        ?>

                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php
                                        // The header image
                                        // Check if this is a post or page, if it has a thumbnail, and if it's a big one
                                        if ( is_singular() && has_post_thumbnail( $post->ID ) &&
                                                        ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
                                                        $image[1] >= $header_image_width ) :
                                                // Houston, we have a new header image!
                                                echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
                                        else :
                                                // Compatibility with versions of WordPress prior to 3.4.
                                                if ( function_exists( 'get_custom_header' ) ) {
                                                        $header_image_width  = get_custom_header()->width;
                                                        $header_image_height = get_custom_header()->height;
                                                } else {
                                                        $header_image_width  = HEADER_IMAGE_WIDTH;
                                                        $header_image_height = HEADER_IMAGE_HEIGHT;
                                                }
                                                ?>

                                        <img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
                                <?php endif; // end check for featured image or standard header ?>
                        </a>
                        <?php endif; // end check for removed header image ?>

                        <?php
                                // Has the text been hidden?
                                if ( 'blank' == get_header_textcolor() ) :
                        ?>
                                <div class="only-search<?php if ( $header_image ) : ?> with-image<?php endif; ?>">
                                <?php get_search_form(); ?>
                                </div>
                        <?php
                                else :
                        ?>
                                <?php get_search_form(); ?>
                        <?php endif; ?>

                        <nav id="access" role="navigation">
                                <h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
                                <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
                                <div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
                                <div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
                                <?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assigned to the primary location is the one used. If one isn't assigned, the menu with the lowest ID is used. */ ?>
                                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                        </nav><!-- #access -->
        </header><!-- #branding -->


        <div id="main">


<div id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

           		<div id="map" style="width: 90%; height: 90%;"></div>

        		<?php get_template_part( 'content', 'page' ); ?>

                	<?php comments_template( '', true ); ?>

        	<?php endwhile; // end of the loop. ?>


	</div><!-- #content -->
</div><!-- #primary -->


<?php get_footer(); ?>

