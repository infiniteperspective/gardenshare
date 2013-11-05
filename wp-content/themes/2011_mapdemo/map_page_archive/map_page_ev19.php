<?php
/**
 * The template for displaying map pages.
 * Template Name: map_page_ev19
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

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/map.js"></script>

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
	    height: 450,
	    width: 475,
	    position:['middle', 120],
	    modal: true,
	    show:'fade',
	    hide:'fade',
	});
        $( "#food_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 325,
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
            <div id="garden_form_container" class="form">
    		<form method="post" id="add_garden_form" name="add_garden_form" action="">
                <div class="element">
                        <label >User Name</label>
                        <input type="text" id="user_name" name="user_name" value= "<?php echo $user_login ?>" readonly=true  />
                </div>
    		<div class="element">
        		<label for="street_address">Street Address</label>
        		<input type="text" id="street_address" name="street_address" class="required" value="" />
    		</div>
    		<div class="element">
        		<label for="city">City</label>
        		<input type="text" id="city" name="city" class="required" value="San Diego" readonly=true />
    		</div>
                <div class="element">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" class="required" value="CA" readonly=true />
                </div>
                <div class="element">
                        <label for="zip_code">Zip Code</label>
                        <input type="number" id="zip_code" name="zip_code" class="required" value="92107" readonly=true />
                </div>
                <div class="element">
                        <label for="square_footage">Square Footage</label>
			<select id="square_footage" class="required" value=""></select>
                </div>
                <div class="element">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="required" value=""></textarea>
                </div>
    		<div class="button_element">
        	<input type="submit" id="add_garden" class="garden_button" value="Add A Garden" />
		</div>
    		</form>
            </div>
	</div>
	<script>
	//this code handles the text input that is taken from the add garden form
	$("#add_garden").click(function () {
          //Begining of input validation using validation plugin
          $("#add_garden_form").validate({
            rules: {
                street_address: { required: true, minlength: 6, maxlength: 30, customvalidation: true },
                city: { required: true, minlength: 5, maxlength: 30 },
                state: { required: true, maxlength: 4 },
                zip_code: { required: true, minlength: 5, maxlength: 6 },
                square_footage: { required: true },
                description: { required: true, customvalidation: true }
          },
	  messages: {
                street_address: { required: "Required field" },
                description: { required: "Tell us about your garden!"}
	  }
	  }); 
	  $.validator.addMethod("customvalidation",
            function(value, element) {
                   return /^[A-Za-z\d=#$%@_ -]+$/.test(value);
            },
	    "Sorry, no special characters allowed"
	  );
          //Defining the variables and populating with form elements
          var address = $("input[id=street_address]");
          var city = $("input[id=city]");
          var state = $("input[id=state]");
          var zipcode = $("input[id=zip_code]");
          var squarefootage = $("select[id=square_footage]");
          var gardendescription = $("textarea[id=description]");
	  //accessing php glogal variable ID which is the primary key of 
	  var userid = $(<?php echo $ID ?>);
	  //serializing the data for post
          var gardendata = userid + address.val() + city.val() + state.val() + zipcode.val() + squarefootage.val() + gardendescription.val();
          console.log(gardendata);   
	  
	  //$("#garden_dialog").dialog("close");
	  //e.preventDefault();
 	  });
	 
	  /* console logging of input fields for debugging
	  console.log(address.val());
	  */
	  
	  //lock form fields
	  //$(".gardentext").attr("disabled","true");

	  /*
	  //call ajax and post data to phphandler
    	  var writegarden = $.ajax({
          url: "addgarden.php",
          type: "post",
          data: gardendata
    	  });
	  */
	  
	  //reset form fields to the default value 
	  //document.forms["add_garden_form"].reset();

	  //$("#garden_dialog").dialog("close");
	
	</script>

	<!-- Add_Food_Exchange_Form --> 
        <div id="food_exchange_dialog" class="dialog" title="Add Food Exchange">
            <div class="food_exchange_form_container">
                <form method="post" id="add_food_exchange_form" name="add_food_exchange_form" action="">
                <div class="element">
                        <label for="plant_for_exchange">Plant for Exchange</label>
                        <input type="text" id="plant_for_exchange" name="plant_for_exchange" class="required" value="" />
                </div>
                <div class="element">
                        <label>Quantity for Exchange</label>
                        <select id="exchange_quantity" name="exchange_quantity" class="required" value="" ></select>
		</div>
                <div class="element">
                        <label>Avail Date</label>
                        <input id="datepicker" name="date_of_availability" class="required" value="" />
                </div>
                <div class="element">
                        <label>Desired Exchange</label>
                        <input type="text" id="desired_exchange" name="desired_exchange" class="required" value="" />
                </div>
                <div class="button_element">
                <input type="submit" id="add_food_exchange" class="garden_button" value="Add Food Exchange" />
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
	//this code handles the text input that is taken from the add food exchange form
        $("#add_food_exchange").click(function () {
	  //Begining of input validation using validation plugin
          $("#add_food_exchange_form").validate({
            rules: {
                plant_for_exchange: { required:true },
                exchange_quantity: { required:true },
                datepicker: { required:true },
                desired_exchange: { required:true }
          }
          }).add_food_exchange_form();  
          });
	
	/*
          var plantforexchange = $("input[id=plant_for_exchange]");
          var exchangequantity = $("select[id=exchange_quantity]");
          var datepicker = $("input[id=datepicker]");
          var desiredexchange = $("input[id=desired_exchange]");
	*/
	  /*
          //beginning of input validation 
          if (plantforexchange.val()=="") {
            console.log("plantforexchange not entered");
            return false;
          } else console.log("plantforexchange entered");
          if (exchangequantity.val()=="") {
            console.log("exchangequantity not entered");
            return false;
          } else console.log("exchangequantity entered");
          if (datepicker.val()=="") {
            console.log("datepicker not entered");
            return false;
          } else console.log("datpicker entered");
          if (desiredexchange.val()=="") {
            console.log("desiredexchange not entered");
            return false;
          } else console.log("desiredexchange entered");
	  */
	  /*
	  console.log(plantforexchange.val());
          console.log(exchangequantity.val());
          console.log(datepicker.val());
          console.log(desiredexchange.val());
	  */

	  //serializing the data for post
          //var fooddata = plantforexchange.val() + exchangequantity.val() + datepicker.val() + desiredexchange.val();
          //console.log(fooddata);    
          
          //lock form fields
          //$(".foodtext").attr("disabled","true");

          /*
          //call ajax and post data to phphandler
          var writefood = $.ajax({
          url: "addfoodexchange.php",
          type: "post",
          data: fooddata
          });
          */

	  //reset the form fields to the default value
          //document.forms["add_food_exchange_form"].reset();

          //$("#food_exchange_dialog").dialog("close");
        </script>

	<!-- Add_Work_Exchange_Form --> 
        <div id="work_exchange_dialog" class="dialog" title="Add Work Exchange">
            <div class="work_exchange_form_container">
                <form method="post" id="add_work_exchange_form" name="add_work_exchange_form" action="">
                <div class="element">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="required" value="" />
                </div>
                <div class="element">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="required" value="" />
                </div>
                <div class="element">
                        <label for="experience">Years of Experience</label>
                        <select id="experience" class="required" value=""></select>
                </div>
                <div class="element">
                        <label for="available_hours">Available Hrs per Week</label>
                        <select id="available_hours" class="required" value=""></select>
                </div>
                <div class="element">
                        <label for="expertise">Describe Expertise</label>
                        <textarea id="expertise" name="expertise" class="required" value=""/></textarea>
                </div>
                <div class="button_element">
                <input type="submit" id="add_work_exchange" class="garden_button" value="Add Work Exchange" />
                <div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
        //this code handles the text input that is taken from the add work exchange form
	$("#add_work_exchange").click(function () {

          $("#add_work_exchange_form").validate({
            rules: {
                first_name: { required:true },
                email: { required:true },
                experience: { required:true },
                available_hours: { required:true },
                expertise: { required:true }
          }
          }).add_work_exchange_form();  
          });
	  /*
          var firstname = $("input[id=first_name]");
          var email = $("input[id=email]");
          var experience = $("select[id=experience]");
          var availablehours = $("select[id=available_hours]");
          var expertise = $("textarea[id=expertise]");
	  */

	  /*
          //beginning of input validation 
          if (firstname.val()=="") {
            console.log("firstname not entered");
            return false;
          } else console.log("firstname entered");
          if (email.val()=="") {
            console.log("email not entered");
            return false;
          } else console.log("email entered");
          if (experience.val()=="") {
            console.log("experience not entered");
            return false;
          } else console.log("experience entered");
          if (availablehours.val()=="") {
            console.log("availablehours not entered");
            return false;
          } else console.log("availablehours entered");
          if (expertise.val()=="") {
            console.log("expertise not entered");
            return false;
          } else console.log("expertise entered");
	  */
	  /*
	  console.log(firstname.val());
          console.log(email.val());
          console.log(experience.val());
          console.log(availablehours.val());
          console.log(expertise.val());
	  */

	  //serializing the data for post
          //var workdata = firstname.val() + email.val() + experience.val() + availablehours.val() + expertise.val();
          //console.log(workdata);    

          //lock form fields
          //$(".worktext").attr("disabled","true");

          /*
          //call ajax and post data to phphandler
          var writegarden = $.ajax({
          url: "addworkexchange.php",
          type: "post",
          data: workdata
          });
          */
          
	  //reset form fields to default value
          //document.forms["add_work_exchange_form"].reset();

          //$("#work_exchange_dialog").dialog("close");
       // });         

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
