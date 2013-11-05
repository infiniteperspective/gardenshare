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

