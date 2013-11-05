<?php
/**
 * The template for displaying map pages.
 * Template Name: map_page_ev15
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
<link rel="stylesheet" href="/wordpress/wp-content/themes/2011_mapdemo/customcss/custom_mint_choc.css"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script>
    $(document).ready(function() {
		
	//Functions to Populate Form Elements 
	$( "#datepicker" ).datepicker();
	
	for(i=1;i<=100;i++)
	{$("#square_footage").append("<option>"+i+"</option>");}

        for(i=1;i<=30;i++)
        {$("#exchange_quantity").append("<option>"+i+"</option>");}

        for(i=1;i<=30;i++)
        {$("#experience").append("<option>"+i+"</option>");}

        for(i=1;i<=40;i++)
        {$("#available_hours").append("<option>"+i+"</option>");}

	//Dialog Window controls defined on DOM creation
        $( "#garden_dialog" ).dialog({
            autoOpen: false,
	    height: 475,
	    width: 450,
	    position:['middle', 120],
	    modal: true,
	    show:'fade',
	    hide:'fade',
	});
        $( "#food_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 300,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade',
        });
        $( "#work_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 400,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade',
        });
        $( "#remove_garden_dialog" ).dialog({
            autoOpen: false,
            height: 175,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade',
        });
        $( "#remove_food_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 175,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade',
        });
        $( "#remove_work_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 175,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade',
        });

	//Binding Button Click Event
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
	<div id="garden_dialog" class="add_garden_class" title="Add Garden">
            <div id="garden_form" class="form">
    		<form method="post">
    		<div class="element">
        		<label>Street Address</label>
        		<input type="text" id="street_address" name="street_address" class="text" />
    		</div>
    		<div class="element">
        		<label>Apt/Suite</label>
        		<input type="text" id="apartment" name="apartment" class="text" />
    		</div>
    		<div class="element">
        		<label>City</label>
        		<input type="text" id="city" name="city" class="text" value="San Diego" readonly=true />
    		</div>
                <div class="element">
                        <label>State</label>
                        <input type="text" id="state" name="state" class="text" value="CA" readonly=true />
                </div>
                <div class="element">
                        <label>Zip Code</label>
                        <input type="number" id="zip_code" name="zip_code" class="text" value="92107" readonly=true />
                </div>
                <div class="element">
                        <label>Square Footage</label>
			<select id="square_footage"></select>
                </div>
                <div class="element">
                        <label>Description</label>
                        <textarea id="description" name="description" class="garden_description" /></textarea>
                </div>
    		<div class="button_element">
        	<input type="button" id="add_garden" class="garden_button" value="Add A Garden" />
    		<div class="loading"></div>
		</div>
    		</form>
            </div>
	</div>
	<script>
	//this code handles the text input that is taken from the add garden form
	$('#add_garden').click(function () {
	  console.log($("#street_address").val());
          console.log($("#apartment").val());
          console.log($("#city").val());
          console.log($("#state").val());
          console.log($("#zip_code").val());
          console.log($("#square_footage").val());
          console.log($("#description").val());

	  $('#garden_dialog').dialog('close');
	});	 
	
	</script>

	<!-- Add_Food_Exchange_Form --> 
        <div id="food_exchange_dialog" class="dialog" title="Add Food Exchange">
            <div class="form">
                <form method="post" >
                <div class="element">
                        <label>Plant for Exchange</label>
                        <input type="text" name="plant_for_exchange" class="text" />
                </div>
                <div class="element">
                        <label>Quantity for Exchange</label>
                        <select id="exchange_quantity" class="text"></select>
		</div>
                <div class="element">
                        <label>Avail Date</label>
                        <input id="datepicker" name="date_of_availability" class="text" />
                </div>
                <div class="element">
                        <label>Desired Exchange</label>
                        <input type="text" name="desired_exchange" class="text" />
                </div>
                <div class="button_element">
                <input type="button" id="add_food_exchange" class="garden_button" value="Add Food Exchange" />
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
        //this code handles the text input that is taken from the add food exchange form
        var foodTest = function() {
        console.log( 'a food exchange was added' );
        };
        var foodexchangeClose = function() {
        $( "#food_exchange_dialog" ).dialog( "close" );
        };
        $('#add_food_exchange').on( 'click', foodTest );
        $('#add_food_exchange').on( 'click', foodexchangeClose );  
        </script>

	<!-- Add_Work_Exchange_Form --> 
        <div id="work_exchange_dialog" class="dialog" title="Add Work Exchange">
            <div class="form">
                <form method="post" >
                <div class="element">
                        <label>Name</label>
                        <input type="text" name="name" class="text" />
                </div>
                <div class="element">
                        <label>Email</label>
                        <input type="text" name="email" class="text" />
                </div>
                <div class="element">
                        <label>Years of Experience</label>
                        <select id="experience" class="text"></select>
                </div>
                <div class="element">
                        <label>Available Hrs per Week</label>
                        <select id="available_hours" class="text"></select>
                </div>
                <div class="element">
                        <label>Describe Expertise</label>
                        <textarea name="expertise" class="text textarea" /></textarea>
                </div>
                <div class="button_element">
                <input type="button" id="add_work_exchange" class="garden_button" value="Add Work Exchange" />
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
        //this code handles the text input that is taken from the add work exchange form
        var workTest = function() {
        console.log( 'a work exchange was added' );
        };      
        var workexchangeClose = function() {
        $( "#work_exchange_dialog" ).dialog( "close" );
        };
        $('#add_work_exchange').on( 'click', workTest );
        $('#add_work_exchange').on( 'click', workexchangeClose );  
        </script>

	<!-- Remove_Garden_Form --> 
        <div id="remove_garden_dialog" class="dialog" title="Remove Garden">
            <div class="form">
                <form method="post" >
                <div class="element">
                        <label>Select Garden</label>
                        <select name="garden_removal" class="text">
			<option>Garden 1</option>
			<option>Garden 2</option>
			<option>Garden 3</option>
			</select>
                </div>
                <div class="button_element">
                <input type="button" id="remove_garden" class="garden_button" value="Remove Garden" />
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
        //this code handles the removal of gardens, soo sad
        var removegardenTest = function() {
        console.log( 'a garden was removed, oh dear!' );
        };      
        var removegardenClose = function() {
        $( "#remove_garden_dialog" ).dialog( "close" );
        };
        $('#remove_garden').on( 'click', removegardenTest );
        $('#remove_garden').on( 'click', removegardenClose );  
        </script>

	<!-- Remove_Food_Exchange_Form --> 
        <div id="remove_food_exchange_dialog" class="dialog" title="Remove Food Exchange">
            <div class="form">
                <form method="post" >
                <div class="element">
                        <label>Select Food Exchange</label>
                        <select name="food_exchange_removal" class="text">
                        <option>Food Exchange 1</option>
                        <option>Food Exchange 2</option>
                        <option>Food Exchange 3</option>
			</select>
                </div>
                <div class="button_element">
                <input type="button" id="remove_food_exchange" class="garden_button" value="Remove Food Exchange" />
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
        //this code handles the removal of food exchanges, soo sad
        var removefoodexchangeTest = function() {
        console.log( 'a food exchange was removed, oh dear!' );
        };      
        var removefoodexchangeClose = function() {
        $( "#remove_food_exchange_dialog" ).dialog( "close" );
        };
        $('#remove_food_exchange').on( 'click', removefoodexchangeTest );
        $('#remove_food_exchange').on( 'click', removefoodexchangeClose );  
	</script>
	<!-- Remove_Work_Exchange_Form --> 
        <div id="remove_work_exchange_dialog" class="dialog" title="Remove Work Exchange">
            <div class="form">
                <form method="post" >
                <div class="element">
                        <label>Select Work Exchange</label>
                        <select name="work_exchange_removal" class="text">
                        <option>Work Exchange 1</option>
                        <option>Work Exchange 2</option>
                        <option>Work Exchange 3</option>
			</select>
                </div>
                <div class="button_element">
                <input type="button" id="remove_work_exchange" class="garden_button" value="Remove Work Exchange" />
                <div class="loading"></div>
                </div>
		</form>
            </div>
        </div>
        <script>
        //this code handles the removal of work exchanges, soo sad
        var removeworkexchangeTest = function() {
        console.log( 'a work exchange was removed, oh dear!' );
        };      
        var removeworkexchangeClose = function() {
        $( "#remove_work_exchange_dialog" ).dialog( "close" );
        };
        $('#remove_work_exchange').on( 'click', removeworkexchangeTest );
        $('#remove_work_exchange').on( 'click', removeworkexchangeClose );  
        </script>

<!-- Buttons -->

<?php
if (is_user_logged_in()){
	echo'<div id="button_cluster">';	
	echo'<div class="width_divider"></div>';
        echo'<button id="add_garden_button" class="garden_button" >Add Garden</button>';
	echo'<button id="add_food_exchange_button" class="garden_button" >Add Food Exchange</button>';
	echo'<button id="add_work_exchange_button" class="garden_button" >Add Work Exchange</button>';
	echo'<br>';
	echo'<div class="width_divider"></div>';
	echo'<button id="remove_garden_button" class="garden_button" >Remove Garden</button>';
	echo'<button id="remove_food_exchange_button" class="garden_button" >Remove Food Exchange</button>';
	echo'<button id="remove_work_exchange_button" class="garden_button" >Remove Work Exchange</button>';
	echo'</div>';
}
else { 
	echo'<div id="guest_display" title="Guest Message Display">';
        echo'<textarea>If you log-in, you can do some really cool stuff like add your own garden, set-up a food exchange, and set-up a work exchange. We do not give email addresses to anyone, no sir. Scouts honor.</textarea>';
	echo'</div>';
}
?>

	<div class="height_divider"></div>
        <!-- Food Exchange Display Area -->
	<h4>Current Food Exchanges</h4>
	<div id="exchange_display" title="Food Exchange Display">
	    <form method="get" id="food_exchange_display">
		<textarea id="food_exchange_text" >This is where we will be displaying the active food exchanges.</textarea> 
	    </form>
	</div>

	<div class="height_divider"></div>
        
	<!-- Work Exchange Display Area -->
	<h4>Current Work Exchanges</h4>
        <div id="exchange_display" title="Work Exchange Display">
            <form method="get" id="work_exchange_display">
                <textarea id="work_exchange_text">This is where we will be displaying the active work exchanges.</textarea>
            </form>
        </div>

	<div class="height_divider"></div>

</div><!-- #primary -->


<?php get_footer(); ?>

