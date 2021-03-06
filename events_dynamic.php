 <?php
    include 'dbconn.php';
 ?>

 <!DOCTYPE html>
  <html>
    <head>
      <title>BMSCE Phase Shift 2017 - Events</title>

      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/materialize_custom.css"/>
      <link rel="icon" href="ps_favicon.ico" type="image/gif" sizes="16x16">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="blue-grey darken-4">
      <div class="container" style="margin-bottom: 30px">
        <h1 class="center-align blue-grey-text text-lighten-4">Events</h1>
        <div class="center-align">
          <a class="waves-effect waves-light btn" href="index.html">Back To Home Page</a>
        </div>
      </div>
      <div class="col s12" style="margin-top: 40px; margin-bottom: 40px">
        <ul class="tabs tabs-fixed-width blue-grey darken-4" id="tab-scroll">
            <li class="tab col s1"><a class="category_btn active" href="#events-list" data-cat-name="Mission Possible">
              <span class="blue-grey-text text-lighten-4">Mission Possible</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Quest Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Across the Panorama">
              <span class="blue-grey-text text-lighten-4">Across The Panorama</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">General Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Ingenuity">
              <span class="blue-grey-text text-lighten-4">Ingenuity</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Creative Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Semicolon Redefined">
              <span class="blue-grey-text text-lighten-4">Semicolon Redefined</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Coding Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Maze Break">
              <span class="blue-grey-text text-lighten-4">Maze Break</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Circuit Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Automatons">
              <span class="blue-grey-text text-lighten-4">Automatons</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Robotics Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Grease Monkey">
              <span class="blue-grey-text text-lighten-4">Grease Monkey</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Mech Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Not so FAQ">
              <span class="blue-grey-text text-lighten-4">Not So FAQ</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Quizzing Events</span>
            </a></li>

            <li class="tab col s1"><a class="category_btn" href="#events-list" data-cat-name="Pioneer">
              <span class="blue-grey-text text-lighten-4">Pioneer</span>
              <br/>
              <span class="blue-grey-text text-lighten-4" style="font-size: 10px">Innovation Events</span>
            </a></li>
        </ul>
      </div>

      <div id="events-list" class="col s12"></div>

      <div id="events-modal" class="modal"></div>

      <!-- <div id="reg-check"></div> -->


      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

      <script>
      function load_events_list(category_name) {
        $("#events-list").empty();
        $("#events-list").load("load-events.php", { cat_name: category_name });
      }

      function load_event_modal(event_name) {
        $("#events-modal").empty();
        $("#events-modal").load("load-event-details.php", { evt_name: event_name });
      }

      function load_registration_form(event_name) {
        $("#events-modal").empty();
        $("#events-modal").load("load-registration-form.php", { evt_name: event_name });
      }

      /*
      function handle_payment(response, event_name) {
        $("#events-modal").empty();
        $("#events-modal").load("handle-payment.php", { payment_id: response.razorpay_payment_id, evt_name: event_name });
      }

      function check_registered_and_open_payment(event_name, fees, name, college, email, phone) {
        $("#reg-check").empty();
        $("#reg-check").load("check-registered.php", { evt_name: event_name, email_id: email }, function() {
          var is_registered = $('#reg-check').children().first().attr('data-is-registered');

          if (is_registered == 'True')
          {
            alert("A person has already registered with this email!");
          }

          else
          {
            var options = {
              "key": "rzp_test_R8DYN4gfYSznyT",
              "amount": fees * 100, // Multiplied by 100 since razor-pay specifies in paisa.
              "name": "BMSCE",
              "description": "Registration for event: " + event_name,
              "handler": function (response) {
                  handle_payment(response, event_name);
              },
              "notes": {
                  "name": name,
                  "college": college,
                  "email": email,
                  "phone": phone
              },
              "theme": {
                  "color": "#F37254"
              }
            };

            var rzp1 = new Razorpay(options);

            rzp1.open();
          }
        });
      }
      */

        $(document).ready(function() {
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();

          $(".category_btn").click(function() {
            var cat_name = $(this).attr("data-cat-name");
            load_events_list(cat_name);
          });

          $("#events-list").on("click", ".event-modal-btn", function() {
            var evt_name = $(this).attr("data-event-name");
            load_event_modal(evt_name);
          });

          $("#events-modal").on("click", ".register-btn", function() {
            var evt_name = $(this).attr("data-event-name");
            load_registration_form(evt_name);
          });

          /*
          $("#events-modal").on("click", ".registration-submit-btn", function() {
            var evt_name = $(this).attr("data-event-name");
            var reg_fees = $(this).attr("data-reg-fees");

            var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if ($('#first_name').val() == "")
            {
              alert("Please enter your first name.");
            }

            else if ($('#last_name').val() == "")
            {
              alert("Please enter your last name.");
            }

            else if ($('#college_name').val() == "")
            {
              alert("Please enter your college name.");
            }

            else if (!email_regex.test($('#email').val()))
            {
              alert("Please enter a valid email.");
            }

            else if ($('#phno').val().length != 10)
            {
              alert("Please enter a valid phone number.");
            }

            else
            {
              check_registered_and_open_payment(evt_name, parseInt(reg_fees), $('#first_name').val() + ' ' + $('#last_name').val(), $('#college_name').val(), $('#email').val(), $('#phno').val());
            }
          });
          */

          $("#events-modal").on("click", ".back-details-btn", function() {
            var evt_name = $(this).attr("data-event-name");
            load_event_modal(evt_name);
          });

          $(".category_btn").first().trigger("click");
        });
      </script>
    </body>
  </html>