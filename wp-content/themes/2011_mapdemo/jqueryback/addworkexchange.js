        <script>
        //this code handles the text input that is taken from the add work exchange form
        $("#add_work_exchange").click(function () {

          $("#add_work_exchange_form").validate({
            rules: {
                first_name: { required:true },
                email: { required:true },
                experience: { required:true },
                available_hours: { required:true },
                workexchangedate: { required:true },
                expertise: { required:true }
          }
          }).add_work_exchange_form();  
          });
          /*
          var firstname = $("input[id=first_name]");
          var email = $("input[id=email]");
          var experience = $("select[id=experience]");
          var availablehours = $("select[id=available_hours]");
          var work_avail_date = $("select[id=workexchangedate]");
          var expertise = $("textarea[id=expertise]");
          var userid = $(<?php echo $ID ?>);
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
          */

          //serializing the data for post
          //var workdata = userid + firstname.val() + email.val() + experience.val() + availablehours.val() + work_avail_date.val() + expertise.val();
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

