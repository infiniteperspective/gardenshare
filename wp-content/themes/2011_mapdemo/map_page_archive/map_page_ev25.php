<?php
/**
 * The template for displaying map pages.
 * Template Name: map_page_ev25
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

<!---Loading all minified external scripts and local stylesheets. Roll ur own stylesheets for sure.--->
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js??key=AIzaSyD81gccHBn5D0xbQMIIT3XBOLjDySe0vNc&sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js"></script>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/js/map.js"></script>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="/wordpress/wp-content/themes/2011_mapdemo/customcss/custom_mint_choc.css"/>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!---PHP to get access to the logged in user id--->
<?php
global $current_user;
$current_user = wp_get_current_user();
?>

<script>
    $(document).ready(function() {
		
	//Functions to Populate Form Elements 
	$( "#foodexchangedate" ).datepicker();

        $( "#workexchangedate" ).datepicker();
	
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
	    height: 490,
	    width: 475,
	    position:['middle', 120],
	    modal: true,
	    show:'fade',
	    hide:'fade',
            close: function () {
            document.forms["add_garden_form"].reset();
            }
	});
        $( "#food_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 325,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade',
            close: function () {
            document.forms["add_food_exchange_form"].reset();
            }
        });
        $( "#work_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 425,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade',
            close: function () {
            document.forms["add_work_exchange_form"].reset();
            }
        });
        $( "#remove_garden_dialog" ).dialog({
            autoOpen: false,
            height: 175,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade'
        });
        $( "#remove_food_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 200,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade'
        });
        $( "#remove_work_exchange_dialog" ).dialog({
            autoOpen: false,
            height: 215,
            width: 450,
            position:['middle', 120],
            modal: true,
            show:'fade',
            hide:'fade'
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
                                        // Compatibility with versions of WordPress prior to 3.4.i
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
    		<form id="add_garden_form" name="add_garden_form" method="post" action="" >
                <div class="element">
                        <label for="user_name">User Name</label>
                        <input type="text" id="user_name" name="user_name" value= "<?php echo $current_user->user_login ?>" readonly=true  />
                </div>
                <div class="element">
                        <label for="garden_name">Garden Name</label>
                        <input type="text" id="garden_name" name="garden_name" class="required" value="" />
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
			<select id="square_footage" class="required" ></select>
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
	  /*//Custom validation methods are defined
          $.validator.addMethod("customvalidation",
            function(value, element) {
                   return /^[A-Za-z\d=#$%@_ -]+$/.test(value);
            },
            "Sorry, no special characters allowed"
          );*/
	  //Form validation begins
          $("#add_garden_form").validate({
            rules: {
                garden_name: { required: true },
                street_address: { required: true, minlength: 6, maxlength: 30 },
                city: { required: true, minlength: 5, maxlength: 30 },
                state: { required: true, maxlength: 4 },
                zip_code: { required: true, minlength: 5, maxlength: 6 },
                square_footage: { required: true },
                description: { required: true }
            }
	  });
	//Here we have a click event for the submit button which takes input from the form and passes it to php for processing
	$("#add_garden").click(function () {
	  //accessing php glogal variable ID  
	  var userid = <?php echo $current_user->ID ?>;
          //Defining the variables and populating with form elements
          var gardenname = $("input[id=garden_name]");
          var address = $("input[id=street_address]");
          var city = $("input[id=city]");
          var state = $("input[id=state]");
          var zipcode = $("input[id=zip_code]");
          var squarefootage = $("select[id=square_footage]");
          var gardendescription = $("textarea[id=description]");
	  
	  //serializing the data for post
          var gardendata = 'userid=' + userid + '&gardenname=' + gardenname.val() + '&address=' + address.val() + '&city=' + city.val() + '&state=' + state.val() + '&zipcode=' + zipcode.val() + '&squarefootage=' + squarefootage.val() + '&gardendescription=' + gardendescription.val();
	  	  
	  //lock form fields
	  $("#add_garden_form").attr("disabled","true");

	  //call ajax and post data to phphandler
    	  var writegarden = $.ajax({
          url: "/wordpress/wp-content/themes/2011_mapdemo/phphandlers/addgarden.php",
          type: "POST",
          data: gardendata,
    	  });
    	  // callback handler that will be called on success
    	  writegarden.done(function (response, textStatus, jqXHR){
          // log a message to the console
          console.log("Hooray, it worked!");
    	  });
    	  // callback handler that will be called on failure
     	  writegarden.fail(function (jqXHR, textStatus, errorThrown){
          // log the error to the console
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
          });
	  //reset form fields to the default value 
	  document.forms["add_garden_form"].reset();
	  
	  //close the dialog
	  $("#garden_dialog").dialog("close");
 	 });
	  
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
                        <input id="foodexchangedate" name="food_availability" class="required" value="" />
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
        $("#add_food_exchange").click(function (event) {
          //preventing the default behavior
          event.preventDefault();    	
          //accessing php glogal variable ID which is the primary key of 
          var userid = <?php echo $current_user->ID ?>;
          var gardenid = 17;
          //Defining the variables and populating with form elements
          var plantforexchange = $("input[id=plant_for_exchange]");
          var exchangequantity = $("select[id=exchange_quantity]");
          var availabilitydate = $("input[id=foodexchangedate]");
          var desiredexchange = $("input[id=desired_exchange]");
	
	  //serializing the data for post
          var fooddata = 'userid=' + userid + '&gardenid=' + gardenid + '&plantforexchange=' + plantforexchange.val() + '&exchangequantity=' +  exchangequantity.val() + '&availabilitydate=' + availabilitydate.val() + '&desiredexchange=' + desiredexchange.val();
          console.log(fooddata);    
          
          //lock form fields
          $("#add_food_exchange_form").attr("disabled","true");

          //call ajax and post data to phphandler
          var writefood = $.ajax({
          url: "/wordpress/wp-content/themes/2011_mapdemo/phphandlers/addfoodexchange.php",
          type: "POST",
          data: fooddata
          });
          // callback handler that will be called on success
          writefood.done(function (response, textStatus, jqXHR){
          // log a message to the console
          console.log("Hooray, it worked!");
          });
          // callback handler that will be called on failure
          writefood.fail(function (jqXHR, textStatus, errorThrown){
          // log the error to the console
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
          });
	  //reset the form fields to the default value
          document.forms["add_food_exchange_form"].reset();
	
	  //close the dialog
          $("#food_exchange_dialog").dialog("close");
	});
        </script>

	<!-- Add_Work_Exchange_Form --> 
        <div id="work_exchange_dialog" class="dialog" title="Add Work Exchange">
            <div class="work_exchange_form_container">
                <form method="post" id="add_work_exchange_form" name="add_work_exchange_form" action="">
                <div class="element">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="required" value= "<?php echo $current_user->user_login ?>" readonly=true />
                </div>
                <div class="element">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="required" value="<?php echo $user_email ?>" readonly=true />
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
                        <label>Avail Date</label>
                        <input id="workexchangedate" name="work_availability" class="required" value="" />
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
	$("#add_work_exchange").click(function (event) {
          //preventing the default behavior
          event.preventDefault();       
          //accessing php glogal variable ID which is the primary key of 
          var userid = <?php echo $current_user->ID ?>;
	  var firstname = $("input[id=first_name]");
          var email = $("input[id=email]");
          var experience = $("select[id=experience]");
          var availablehours = $("select[id=available_hours]");
          var availabledate = $("input[id=workexchangedate]");
          var expertise = $("textarea[id=expertise]");
	  
	  //serializing the data for post
          var workdata = 'userid=' + userid + '&firstname=' + firstname.val() + '&email=' + email.val() + '&experience=' + experience.val() + '&availablehours=' + availablehours.val() + '&availabledate=' + availabledate.val() + '&expertise=' + expertise.val();
          console.log(workdata);    

          //lock form fields
          $(".worktext").attr("disabled","true");

          //call ajax and post data to phphandler
          var writework = $.ajax({
          url: "/wordpress/wp-content/themes/2011_mapdemo/phphandlers/addworkexchange.php",
          type: "POST",
          data: workdata
          });
          // callback handler that will be called on success
          writework.done(function (response, textStatus, jqXHR){
          // log a message to the console
          console.log("Hooray, it worked!");
          });
          // callback handler that will be called on failure
          writework.fail(function (jqXHR, textStatus, errorThrown){
          // log the error to the console
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
          });
	  //reset form fields to default value
          document.forms["add_work_exchange_form"].reset();

          //close the dialog
          $("#work_exchange_dialog").dialog("close");
        });         

	</script>

	<!-- Remove_Garden_Form --> 
        <div id="remove_garden_dialog" class="dialog" title="Remove Garden">
            <div class="form">
                <form id="remove_garden_form" method="post" >
	<!-- PHP script to populate the food exchange removal pulldown -->
	<?php
	require_once(ABSPATH. '/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');
	//Connect to MySQL Server 
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

	//check connection
	if ($conn->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();}

	$userid = $current_user->ID;
	//Build the SQL query
	$query = "SELECT garden_name FROM gardens LEFT JOIN wp_users ON wp_users.ID = $userid;";
	//Execute query and store result
	$result = $conn->query($query);
	while ($row = $result->fetch_array(MYSQLI_NUM)){
        	$gardens [] = $row[0];}
	echo "<div class=\"element\">\n";
	echo "  <label>Select Garden</label>\n";
	echo "  <select name=\"garden_removal\" class=\"text\" >\n";
	foreach ($gardens as $value){
	echo "      <option>$value</option>\n";}
	echo "  </select>\n";
	echo "</div>\n";

	?>
                <div class="button_element">
                	<input type="button" id="remove_garden" class="garden_button" value="Remove Garden" />
                	<div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
        $("#remove_garden").click(function (event) {
          //preventing the default behavior
          event.preventDefault();       
          //accessing php glogal variable ID which is the primary key of 
          var userid = <?php echo $current_user->ID ?>;
          
	  //serializing the data for post
          var rmgardendata = 'userid=' + userid;
          console.log(rmgardendata);    

          //call ajax and post data to phphandler
          var removegarden = $.ajax({
          url: "/wordpress/wp-content/themes/2011_mapdemo/phphandlers/removegarden.php",
          type: "POST",
          data: rmgardendata
          });
          // callback handler that will be called on success
          removegarden.done(function (response, textStatus, jqXHR){
          // log a message to the console
          console.log("Hooray, it worked!");
          });
          // callback handler that will be called on failure
          removegarden.fail(function (jqXHR, textStatus, errorThrown){
          // log the error to the console
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
          });
          //reset form fields to default value
          document.forms["remove_garden_form"].reset();

          //close the dialog
          $("#remove_garden_dialog").dialog("close");
        });         
        </script>
	<!-- Remove_Food_Exchange_Form --> 
        <div id="remove_food_exchange_dialog" class="dialog" title="Remove Food Exchange">
            <div class="form">
                <form id="remove_food_exchange_form" method="post" >
	<!-- PHP script to populate the food exchange removal pulldown --> 
	<?php
	require_once(ABSPATH. '/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');
	//Connect to MySQL Server 
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

	//check connection
	if ($conn->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();}

	$userid = $current_user->ID;
	//Build the SQL query
	$query = "SELECT plantforexchange, available_date FROM food_exchanges LEFT JOIN wp_users ON wp_users.ID = $userid;";
	//Execute query and store result

	$result = $conn->query($query);
	while ($row = $result->fetch_array(MYSQLI_NUM)){
        	$exchange [] = $row[0];
        	$date [] = $row[1];}
	echo "<div class=\"element\">\n";
	echo "  <label>Select Food Exchange</label>\n";
	echo "  <select name=\"food_exchange_removal\" class=\"text\" >\n";
	foreach ($exchange as $value){
	echo "      <option>$value</option>\n";}
	echo "  </select>\n";
	echo "</div>\n";
	echo "<div class=\"element\">\n";
	echo "  <label>Avail Date</label>\n";
	foreach ($date as $avail){
	echo "  <input type=\"text\" value=\"$avail\" readonly=true />\n";}
	echo "</div>\n";

	?>
                <div class="button_element">
                	<input type="button" id="remove_food_exchange" class="garden_button" value="Remove Food Exchange" />
                	<div class="loading"></div>
                </div>
                </form>
            </div>
        </div>
        <script>
        //this code handles the removal of food exchanges, soo sad
        $("#remove_food_exchange").click(function (event) {
          //preventing the default behavior
          event.preventDefault();       
          //accessing php glogal variable ID which is the primary key of 
          var userid = <?php echo $current_user->ID ?>;
          
          //serializing the data for post
          var rmfooddata = 'userid=' + userid;
          console.log(rmfooddata);    

          //call ajax and post data to phphandler
          var removefood = $.ajax({
          url: "/wordpress/wp-content/themes/2011_mapdemo/phphandlers/removefoodexchange.php",
          type: "POST",
          data: rmfooddata
          });
          // callback handler that will be called on success
          removefood.done(function (response, textStatus, jqXHR){
          // log a message to the console
          console.log("Hooray, it worked!");
          });
          // callback handler that will be called on failure
          removefood.fail(function (jqXHR, textStatus, errorThrown){
          // log the error to the console
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
          });
          //reset form fields to default value
          document.forms["remove_food_exchange_form"].reset();

          //close the dialog
          $("#remove_food_exchange_dialog").dialog("close");
        });         
	</script>
	<!-- Remove_Work_Exchange_Form --> 
        <div id="remove_work_exchange_dialog" class="dialog" title="Remove Work Exchange">
            <div class="form">
                <form id="remove_work_exchange_form">
                <div class="element">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="required" value= "<?php echo $current_user->user_login ?>" readonly=true />
                </div>
	<!-- PHP script to populate the food exchange removal pulldown -->
	<?php
	require_once(ABSPATH. '/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');
	//Connect to MySQL Server 
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );
	
	//check connection
	if ($conn->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();}

	$userid = $current_user->ID;
	//Build the SQL query
	$query = "SELECT available_date FROM work_exchanges LEFT JOIN wp_users ON wp_users.ID = $userid;";
	//Execute query and store result

	$result = $conn->query($query);
	echo "<div class=\"element\">\n";
	echo "  <label>Available Date</label>\n";
	echo "  <input type=\"text\" name=\"available_date\" class=\"text\" value=\"\" readonly=true \>\n";
	echo "</div>\n";

	?>
                <div class="button_element">
                	<input type="button" id="remove_work_exchange" class="garden_button" value="Remove Work Exchange" />
                	<div class="loading"></div>
                </div>
		</form>
            </div>
        </div>
        <script>
        //this code handles the removal of work exchanges, soo sad
          $("#remove_work_exchange").click(function (event) {
          //preventing the default behavior
          event.preventDefault();       
          //accessing php glogal variable ID which is the primary key of 
          var userid = <?php echo $current_user->ID ?>;
          
          //serializing the data for post
          var rmworkdata = 'userid=' + userid;
          console.log(rmworkdata);    

          //call ajax and post data to phphandler
          var removework = $.ajax({
          url: "/wordpress/wp-content/themes/2011_mapdemo/phphandlers/removeworkexchange.php",
          type: "POST",
          data: rmworkdata
          });
          // callback handler that will be called on success
          removework.done(function (response, textStatus, jqXHR){
          // log a message to the console
          console.log("Hooray, it worked!");
          });
          // callback handler that will be called on failure
          removework.fail(function (jqXHR, textStatus, errorThrown){
          // log the error to the console
          console.error(
            "The following error occured: "+
            textStatus, errorThrown
          );
          });
          //reset form fields to default value
          document.forms["remove_work_exchange_form"].reset();

          //close the dialog
          $("#remove_work_exchange_dialog").dialog("close");
        });         
	/*var removeworkexchangeTest = function() {
        console.log( 'a work exchange was removed, oh dear!' );
        };      
        var removeworkexchangeClose = function() {
        $( "#remove_work_exchange_dialog" ).dialog( "close" );
        };
        $('#remove_work_exchange').on( 'click', removeworkexchangeTest );
        $('#remove_work_exchange').on( 'click', removeworkexchangeClose );
	*/  
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
	<!---Server side script to populate the food exchange------!>
	<?php
	require_once(ABSPATH. '/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');
	//Connect to MySQL Server 
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

	//check connection
	if ($conn->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();}

	//Build the SQL query
	$query = "SELECT plantforexchange, quantity, available_date, desired_exchange, user_nicename, user_email FROM food_exchanges, wp_users WHERE userid=ID LIMIT 10";
	//Execute query and store result
	$result = $conn->query($query);

	echo "<div id=\"exchange_display\" title=\"Food Exchange Display\">\n";
	echo    "<form id=\"food_exchange_display\">\n";
	echo       "<textarea id=\"food_exchange_text\" readonly=true >\n";
	//Accessing resultset array
	while ($row = $result->fetch_array(MYSQLI_NUM)){printf ("Plant for Exchange: %s, Quantity: %s, Available Date: %s, Desired Plant: %s , POC: %s, Email: %s \n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);}
	echo "</textarea>\n";
	echo    "</form>\n";
	echo "</div>\n";

	//Releasing the memory location that is storing the resultset and 
	//closing the connection.
	$result->free();
	$conn->close();
	?>

	<div class="height_divider"></div>
        
	<!-- Work Exchange Display Area -->
	<h4>Current Work Exchanges</h4>
	<!---Server side script to populate the work exchange------!>
	<?php
	require_once(ABSPATH. '/wp-content/themes/2011_mapdemo/phphandlers/dbconnect.php');
	//Connect to MySQL Server 
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname );

	//check connection
	if ($conn->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
    	exit();}

	//Build the SQL query
	$query = "SELECT first_name, experience, availability, available_date, email, expertise FROM work_exchanges LIMIT 10;";
	//Execute query and store result
	$result = $conn->query($query);

	echo "<div id=\"exchange_display\" title=\"Work Exchange Display\">\n";
	echo    "<form id=\"work_exchange_display\">\n";
	echo       "<textarea id=\"work_exchange_text\" readonly=true >\n";
	//Accessing resultset array
        while ($row = $result->fetch_array(MYSQLI_NUM)){
                printf ("First Name: %s, Experience(yrs): %s, Availability (Hrs/wk): %s, Available Date: %s, Email: %s, Expertise: %s\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);}
	echo "</textarea>\n";
	echo    "</form>\n";
	echo "</div>\n";

	//Releasing the memory location that is storing the resultset and 
	//closing the connection.
	$result->free();
	$conn->close();
	?>

	<div class="height_divider"></div>
