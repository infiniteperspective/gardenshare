<?php
/**
 * The template for displaying map pages.
 * Template Name: map_page_ev10
 * This is the template that displays map pages.
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

<!--Moving the Javascript into head tag for ev4, adding support for infobox utility ev7-->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/map.js"></script>

<!--This was added for ev3-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script>
    $(function() {
        $( "#garden_dialog" ).dialog({
            autoOpen: false,
	    height: 300,
	    width: 300,
	    position:['middle', 120],
	    modal: true
        });
        $( "#food_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 300,
            width: 300,
            position:['middle', 120],
            modal: true
        });
        $( "#work_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 300,
            width: 300,
            position:['middle', 120],
            modal: true
        });
        $( "#remove_garden_dialog" ).dialog({
            autoOpen: false,
            height: 300,
            width: 300,
            position:['middle', 120],
            modal: true
        });
        $( "#remove_food_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 300,
            width: 300,
            position:['middle', 120],
            modal: true
        });
        $( "#remove_work_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 300,
            width: 300,
            position:['middle', 120],
            modal: true
        });

 
        $( "#add_garden_button" ).click(function() {
            $( "#garden_dialog" ).dialog( "open" );
            return false;
        });
        $( "#add_food_exchange_button" ).click(function() {
            $( "#food_exchange_dialog" ).dialog( "open" );
            return false;
        });
        $( "#add_work_exchange_button" ).click(function() {
            $( "#work_exchange_dialog" ).dialog( "open" );
            return false;
        });
        $( "#remove_garden_button" ).click(function() {
            $( "#remove_garden_dialog" ).dialog( "open" );
            return false;
        });
        $( "#remove_food_exchange_button" ).click(function() {
            $( "#remove_food_exchange_dialog" ).dialog( "open" );
            return false;
        });
        $( "#remove_work_exchange_button" ).click(function() {
            $( "#remove_work_exchange_dialog" ).dialog( "open" );
            return false;
        });

    });
</script>
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
        
	<!-- Add_Garden_Form --> 
	<div id="garden_dialog" class="dialog" title="Add Garden">
	    <div class="form">
    		<form method="post" action="process.php">
    		<div class="element">
        		<label>Name</label>
        		<input type="text" name="name" class="text" />
    		</div>
    		<div class="element">
        		<label>Email</label>
        		<input type="text" name="email" class="text" />
    		</div>
    		<div class="element">
        		<label>Website</label>
        		<input type="text" name="website" class="text" />
    		</div>
    		<div class="element">
        		<label>Comment</label>
        		<textarea name="comment" class="text textarea" /></textarea>
    		</div>
    		<div class="element">
         
        	<input type="submit" id="submit"/>
        	<div class="loading"></div>
    		</div>
    		</form>
    	    </div>
	</div>

	<!-- Add_Food_Exchange_Form --> 
        <div id="food_exchange_dialog" class="dialog" title="Add Food Exchange">
            <div class="form">
                <form method="post" action="process.php">
                <div class="element">
                        <label>Name</label>
                        <input type="text" name="name" class="text" />
                </div>
                <div class="element">
                        <label>Email</label>
                        <input type="text" name="email" class="text" />
                </div>
                <div class="element">
                        <label>Website</label>
                        <input type="text" name="website" class="text" />
                </div>
                <div class="element">
                        <label>Comment</label>
                        <textarea name="comment" class="text textarea" /></textarea>
                </div>
                <div class="element">

                <input type="submit" id="submit"/>
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>

	<!-- Add_Work_Exchange_Form --> 
        <div id="work_exchange_dialog" class="dialog" title="Add Work Exchange">
            <div class="form">
                <form method="post" action="process.php">
                <div class="element">
                        <label>Name</label>
                        <input type="text" name="name" class="text" />
                </div>
                <div class="element">
                        <label>Email</label>
                        <input type="text" name="email" class="text" />
                </div>
                <div class="element">
                        <label>Website</label>
                        <input type="text" name="website" class="text" />
                </div>
                <div class="element">
                        <label>Comment</label>
                        <textarea name="comment" class="text textarea" /></textarea>
                </div>
                <div class="element">

                <input type="submit" id="submit"/>
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>

	<!-- Remove_Garden_Form --> 
        <div id="remove_garden_dialog" class="dialog" title="Remove Garden">
            <div class="form">
                <form method="post" action="process.php">
                <div class="element">
                        <label>Name</label>
                        <input type="text" name="name" class="text" />
                </div>
                <div class="element">
                        <label>Email</label>
                        <input type="text" name="email" class="text" />
                </div>
                <div class="element">
                        <label>Website</label>
                        <input type="text" name="website" class="text" />
                </div>
                <div class="element">
                        <label>Comment</label>
                        <textarea name="comment" class="text textarea" /></textarea>
                </div>
                <div class="element">

                <input type="submit" id="submit"/>
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>

	<!-- Remove_Food_Exchange_Form --> 
        <div id="remove_food_exchange_dialog" class="dialog" title="Remove Food Exchange">
            <div class="form">
                <form method="post" action="process.php">
                <div class="element">
                        <label>Name</label>
                        <input type="text" name="name" class="text" />
                </div>
                <div class="element">
                        <label>Email</label>
                        <input type="text" name="email" class="text" />
                </div>
                <div class="element">
                        <label>Website</label>
                        <input type="text" name="website" class="text" />
                </div>
                <div class="element">
                        <label>Comment</label>
                        <textarea name="comment" class="text textarea" /></textarea>
                </div>
                <div class="element">

                <input type="submit" id="submit"/>
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>

	<!-- Remove_Work_Exchange_Form --> 
        <div id="remove_work_exchange_dialog" class="dialog" title="Remove Work Exchange">
            <div class="form">
                <form method="post" action="process.php">
                <div class="element">
                        <label>Name</label>
                        <input type="text" name="name" class="text" />
                </div>
                <div class="element">
                        <label>Email</label>
                        <input type="text" name="email" class="text" />
                </div>
                <div class="element">
                        <label>Website</label>
                        <input type="text" name="website" class="text" />
                </div>
                <div class="element">
                        <label>Comment</label>
                        <textarea name="comment" class="text textarea" /></textarea>
                </div>
                <div class="element">

                <input type="submit" id="submit"/>
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>

        <!-- Buttons -->
	<div id="button_cluster">	
	<div class="width_divider"></div>
        <button id="add_garden_button" class="garden_button" >Add A Garden</button>
	<button id="add_food_exchange_button" class="garden_button" >Add Food Exchange</button>
	<button id="add_work_exchange_button" class="garden_button" >Add Work Exchange</button>
	<br>
	<div class="width_divider"></div>
	<button id="remove_garden_button" class="garden_button" >Remove Garden</button>
	<button id="remove_food_exchange_button" class="garden_button" >Remove Food Exchange</button>
	<button id="remove_work_exchange_button" class="garden_button" >Remove Work Exchange</button>
	</div>

	<div class="height_divider"></div>

        <!-- Food Exchange Display Area -->
	<h4>Current Food Exchanges</h4>
	<div id="food_exchange_display" class="food_exchange" title="Food Exchange Display">
	    <form method="get" id="food_exchange_display" class="food_exchange">
		<textarea id="food_exchange_text" class="food_exchange">This is where we will be displaying the active food exchanges.</textarea> 
	    </form>
	</div>

	<div class="height_divider"></div>
        
	<!-- Work Exchange Display Area -->
	<h4>Current Work Exchanges</h4>
        <div id="work_exchange_display" class="work_exchange" title="Work Exchange Display">
            <form method="get" id="work_exchange_display" class="work_exchange">
                <textarea id="work_exchange_text" class="work_exchange">This is where we will be displaying the active work exchanges.</textarea>
            </form>
        </div>


</div><!-- #primary -->


<?php get_footer(); ?>

