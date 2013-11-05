<script>
        //this code handles the text input that is taken from the add garden form
        $("#add_garden").click(function () {
          //Begining of input validation using validation plugin
          $("#add_garden_form").validate({
            rules: {
                garden_name: { required: true, customvalidation: true },
                street_address: { required: true, minlength: 6, maxlength: 30, customvalidation: true },
                city: { required: true, minlength: 5, maxlength: 30 },
                state: { required: true, maxlength: 4 },
                zip_code: { required: true, minlength: 5, maxlength: 6 },
                square_footage: { required: true },
                description: { required: true, customvalidation: true }
          },
          messages: {
                garden_name: { required: "Required field" },
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
          //accessing php glogal variable ID which is the primary key of 
          var userid = <? echo $current_user->ID ?>;
          //Defining the variables and populating with form elements
          //var gardename = $("input[id=garden_name]");
          //var address = $("input[id=street_address]");
          //var city = $("input[id=city]");
          //var state = $("input[id=state]");
          //var zipcode = $("input[id=zip_code]");
          //var squarefootage = $("select[id=square_footage]");
          //var gardendescription = $("textarea[id=description]");
          
          //serializing the data for post
          //var gardendata = userid + garden_name.val() + address.val() + city.val() + state.val() + zipcode.val() + squarefootage.val() + gardendescription.val();
          var gardendata = userid;
          //console.log(gardendata);   
          
          //$("#garden_dialog").dialog("close");
          //e.preventDefault();

          // console logging of input fields for debugging
          //console.log(address.val());
          
          
          //lock form fields
          //$(".gardentext").attr("disabled","true");


          //call ajax and post data to phphandler
          var writegarden = $.ajax({
          url: "addgarden.php",
          type: "post",
          data: gardendata
          });

          });
          
          //reset form fields to the default value 
          //document.forms["add_garden_form"].reset();

          //$("#garden_dialog").dialog("close");
        
        </script>

