<?php
/* Template Name: Template Adventure Costa */

$add_section = true;
if ( function_exists('is_woocommerce') ) {
    if ( is_woocommerce() || is_cart() || is_checkout() ) {
        $add_section = false;
    }
}
if ($add_section) {
    $vc_status_meta = get_post_meta( $post->ID, '_wpb_vc_js_status', true );
    if (!empty($vc_status_meta)) {
        $add_section = $vc_status_meta === 'false';
    }
}
$allow_comments = oxy_get_option( 'site_comments' );
get_header();
global $post;
oxy_page_header( $post->ID, array( 'heading_type' => 'page' ) );
$template_margin = oxy_get_option('template_margin');

if(isset($_POST["btn_sb"]))
{
    /*$name=$_POST["full_nm"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $arrival_date=$_POST["datepicker1_pop"];
    $departure_date=$_POST["datepicker2_pop"];
    $choice=$_POST["slct_pop"];*/
    
    $fullname=$_POST["fullname"];
    $email=$_POST["email"];
    $choice=$_POST["slct"];
    
    $to = "info@crvacationing.com"; 
    $subject = "Whale Watching Tour";

        $message = "
        <html>
        <head>
        <title>Costaricavacation</title>
        </head>
        <body>
        <p>Customer's Description: </p>
        <table border='1'>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Tour Choice</th>
        </tr>
        <tr>
        <td>".$fullname."</td>
        <td>".$email."</td>
        <td>".$choice."</td>
        </tr>
        </table>
        </body>
        </html>
        ";

// Always set content-type when sending HTML email
$headers = 'From: <costaricavacationing.com>' . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

if(mail($to,$subject,$message,$headers))
{
   //alert("Thank you for choosing us!"); 
   echo "<script>
alert('Thank you!  We have got your request and a travel expert will get back to soon.  Please visit our website for more Costa Rica stuff!');
window.location.assign('https://costaricavacationing.com/thank-you-whale-lp/');
</script>";
}
}
?>


    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/css/grid.css">
    <!--<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/css/animate.css">-->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/css/style.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/css/camera.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/css/jquery.fancybox.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/css/booking.css">
    <script src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/js/device.min.js"></script>
    
    
     <!--<script src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/js/jquery.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/js/jquery-migrate-1.2.1.js"></script>-->
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: #8c8b8b;
  color: #fff;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid #c7c7c7;
}

.packages_list_one li {
    margin: 0 0 0 2%;
}

.packages_description_one {
    text-align: justify;
}

.booking-form .input_container input {
    background: #fff;
}


/* Reset Select */
select {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  outline: 0;
  box-shadow: none;
  border: 0 !important;
  background: #fff;
  background-image: none;
}
/* Custom Select */
.select {
  position: relative;
  display: inline-block;
  width: 14em;
  height: 2.4em;
  line-height: 2.4;
  /*background: #ebebe0;*/
  overflow: hidden;
  border-radius: .25em;
  border: 1px solid #c7c7c7;
}
select {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0 0 0 .5em;
  /*color: #000;*/
  cursor: pointer;
  font-size: 18px;
}
select::-ms-expand {
  display: none;
}
/* Arrow */
.select::after {
  content: '\25BC';
  position: absolute;
  top: 0;
  right: 0;
  bottom: 1;
  padding: 0 0.5em;
  background: #ccccb3;
  pointer-events: none;
}
/* Transition */
.select:hover::after {
  color: #ff6738;
}
.select::after {
  -webkit-transition: .25s all ease;
  -o-transition: .25s all ease;
  transition: .25s all ease;
}


/*modal*/
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 400px;
  padding: 20px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #008000;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: green;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.form-popup .close_cross_popup {
    margin-top: -10px;
    float: right;
    color: #ff0000;
    cursor: pointer;
}


.form-popup {
   
    z-index: 99999999999;
    top: 0%;
   
    /* left: calc(50% - 153px); */
    left:0px;
    
    width:100%;
    background: rgba(0, 0, 0, 0.49);
}


.form-popup .btn {
    display: inline-block;
    
    height: inherit; 

    font: 700 16px/5px "Open Sans Condensed", sans-serif;
}



.form-container {
   
    margin: 6% auto;
}

.fa-facebook-square {
    color: #3b5998;
}

.ins1 .change_two img {
    height: 259px;
}

.fade_inleft_costa img {
    height: 310px;
}
.btn_type input {
    margin-top: 30px;
    padding: 5px 22px 5px;
    width: 52%;
    color: #FFF;
    background: #ff6738;
    border: 1px solid #ebebe0;
    font-family: "Open Sans Condensed", sans-serif;
    font-weight: 700;
    font-size: 22px;
    border-radius: 25px;
    text-align: center;
    text-transform: uppercase;
}
.btn_type input:hover {
  background-color: #ff6738;
}


@media (max-width: 500px) {

/*.parallax h2 {
    font-size: 26px;
    line-height: 120px;
}

.well3 {
    padding-top: 60px;
    padding-bottom: 15px;
}*/

.booking-form .tmInput + .tmInput {
   
     margin-left: 0px; 
}

.gj-datepicker-md [role=right-icon] {
   
    right:5px;
    top: 9px;
    
}

.booking_wr h4 + * {
    margin-left: 0px;
}

.booking-form input {
   
        width: 188px; 
}

.booking-form .select {
   
        width: 188px; 
}


footer {
   
    padding-bottom: 150px;
}

.form-container {
  max-width: 300px;
}
}  

</style>
	     
	     
 
    <div class="page-main-content">
      <!--
      ========================================================
      							HEADER
      ========================================================
      -->
      <header>
        <div class="header_panel">
          <div class="container">
            <div class="brand" style="display: none;">
                <!--
              <h1 class="brand_name"><a href="./">Travel</a></h1>
              <p class="brand_slogan">Guide</p>
              -->
            </div>
            <div class="booking_wr">
              <form action="" id="bookingForm" class="booking-form center" method="post" >
                <h2 class="center" style="color: #fff;">EXPLORE COSTA RICA WHALE WATCHING AND MORE   <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/flag_of_costarica.ico" height="55" width="55" alt=""></h2>
                <h4 class="center" style="color: #fff;">FULL TRAVEL INTENERARIESS TO EXPLORE COSTA RICA</h4>
                
                <div class="tmInput input_container">
                    
                <input type="text" name="fullname" id="fullname" placeholder="Name"  required>
                </div>
                
                <div class="tmInput input_container">
                    
    
                <input type="email" name="email" id="email" placeholder="Email" class="input-field" required>
                </div>
                
                 <div class="tmInput select">
                  <select name="slct" id="slct" required>
                      <option value="" hidden>Drop Down</option>
                      <option value="$1603pp-Luxury In The Jungle">$1603pp-Luxury In The Jungle</option>
                      <option value="$999pp-Special Offer">$999pp-Special Offer</option>
                      <option value="$1418pp-Cristal Ballena">$1418pp-Whale Tail View</option>
                      <option value="Just Whale Tour">Just Whale Tour</option>
                      <option value="Just Dolphin Tour">Just Dolphin Tour</option>
    </select>
                </div>
                
                  <div style="margin-top: 40px; text-align: center;" class="btn_type">
                      <!--<a href="" data-type="submit" id="submitform" name="btn_sb" onclick="return openForm()">Check Availability Now and Get upto $100 OFF</a>-->
                      <input type="submit" name="btn_sb" value="Check Availability Now and Get $100 OFF" onclick="return openFun()"/>
                  </div>
                <!--<p style="text-align: center;"><small>* WE WILL NEVER SELL OR SHARE YOUR PERSONAL INFORMATION</small></p>-->
              </form>
              
    <!--<input id="datepicker" width="276" />-->
              
            </div>
          </div>
        </div>
        
        <div class="camera_container">
             
          <!--<div id="camera" class="camera_wrap">           
            <div data-src="images/page-1_slide01.jpg">
              <div class="camera_caption fadeIn"></div>
            </div>

            <div data-src="images/page-1_slide02.jpg">
              <div class="camera_caption fadeIn"></div>
            </div>
            <div data-src="images/page-1_slide03.jpg">
              <div class="camera_caption fadeIn"></div>
            </div>
         
          </div>-->
             
        </div>
        
        <!--<div class="my_camera_container" style="background-size: 100%;"></div>-->
      </header><br><br>
      <!--
      ========================================================
      							CONTENT
      ========================================================
      -->
      <main>
          <section class="well ins1">
          <div class="container">
            <h2 class="center" style="font-size: 50px;"><img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/favicon_costa_icon.png" height="55" width="55" alt=""> BEST VALUE PACKAGES</h2>
            <p class="txt1 center">These are our most popular 7 Day Travel Packages with Whale Watching Tours.</p><br>
            <p><strong>All our whale watching travel packages include:</strong></p>
            <ul class="packages_list_one" style="list-style-type:disc;">
                <li>Dolphin and Whale Tour Combo</li>
                <li>3 – 5 * Hotels</li>
                <li>Local guides</li>
                <li>National park entrance fees</li>
                <li>4x4 car rental</li>
                <li>Airport transfer</li>
                <li>All the support you may need during your stay in Costa Rica.</li>
            </ul><br>
            <p class="packages_description_one">Our Whale watching tour operator is your best chance to see the whales visiting the coast of the Marino Ballena (Marine Bay) National Park. Our boats depart from Punta Uvita Beach and visit the famous Punta Uvita Whale’s Tail, Ballena Island, Tres Hermanas Islets and Ventana Sea Caves. During the tour we search for Humpback Whales and two different species of resident Dolphins. When granted the opportunity, you might see and hear the song of the Humpback Whales and or observe the acrobatic.</p>
            <ul class="pricing-table row">
              <li data-equal-group="1" data-wow-delay=".3s" class="grid_3 wow fadeInLeft change_one"><img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/firstpackage.jpeg" alt="">
                <div class="price">$1603<sup>pp</sup></div>
                <p><strong>Whale Watching at the Whales Tail – Luxury In The Jungle</strong></p><br>
                <p>Spend 7 amazing days in Costa Rica, in top luxury boutique hotels in the jungle! Includes Whale and Dolphin watching plus visiting wildlife sanctuary’s and the ancient the Boruca indigenous tribe! Ventanas and Tortuga beaches are due south and are an explorer's dream when the tides are out and you are able to walk into the caves. This is a favorite laying ground for the Olive Ridley and Leatherback turtles and if you are lucky you will happen upon a release of the hatchings.</p><a href="#" class="link">Book Now</a>
              </li>
              <li data-equal-group="1" class="grid_3 wow fadeInLeft change_two"><img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/second_package.png" alt="">
                <div class="price">$999<sup>pp</sup></div>
                <p><strong>Whale Watching at the Whales Tail – Special Offer</strong></p><br>
                <p>Stay in the southern pacific of Costa Rica where the rain forests meet the beach! Your room with balcony overlooks the whale’s tail and will be something you won’t forget! You have access to world famous waterfalls and miles of coastline.</p>
                <p>Imagine drinking a cocktail from the infinity pool overlooking the ocean whilst whale watching - unforgettable experience.</p>
                <a href="#" class="link">Book Now</a>
              </li>
              <li data-equal-group="1" class="grid_3 wow fadeInRight change_three"><img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/thirdpackage.png" alt="">
                <div class="price">$1418<sup>pp</sup></div>
                <p><strong>Whale Watching at the Whales Tail - Whale Tail View </strong></p><br>
                <p>This is the highest valued itinerary for this green season & whale watching you will find! Your hotel has great views of the bay and offers large, beautiful & open rooms. Tucked high in the hills, expect amazing sunsets and chances for whale spotting from the bar and restaurant areas. Experience local indigenous tribe culture and visit an animal sanctuary – Pura Vida!.</p><a href="#" class="link">Book Now</a>
              </li>
              <!--<li data-equal-group="1" data-wow-delay=".3s" class="grid_3 wow fadeInRight change_four"><img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img17.jpg" alt="">
                <div class="price">$999.<sup>99</sup></div>
                <p>Luxury acomodations at in paradise at accesibale pricing? Yes, book with us for as little as $999pp</p><a href="#" class="link">More</a>
              </li>-->
            </ul>
          </div>
        </section>
          
          
        <!--
        <section class="well2">
          <div class="container">
            <h2 class="center">News & events</h2>
            <p class="txt1 center">Penepre henderitui in ea voluptate velit eslertase quam nihil molestiae consequatur.</p>
            <div class="row off2">
              <article class="grid_6 wow fadeInRight">
                <div class="row">
                  <div class="grid_3"><img src="images/page-1_img04.jpg" alt="" class="mg-add"></div>
                  <div class="grid_3">
                    <time datetime="2015-10-13">13/10</time>
                    <h5 class="primary"><a href="#">Cenaserleceas strices phal edaty fenanec sit aser rment  lement velursu.</a></h5>
                    <p>Ut ts dolor apegement velu rsusen elnean ctor wisetaurna aserta. Aliam eratvpa miuyas tis ac turpis. </p>
                  </div>
                </div>
              </article>
              <article data-wow-delay=".2s" class="grid_6 wow fadeInRight">
                <div class="row">
                  <div class="grid_3"><img src="images/page-1_img05.jpg" alt="" class="mg-add"></div>
                  <div class="grid_3">
                    <time datetime="2015-10-12">12/10</time>
                    <h5 class="primary"><a href="#">Leugiata lesrleceas ctrasi ices phaledaty fenanec sitets aser erment dopegete.</a></h5>
                    <p>Moleacene anrit meases dey uam socis natoqu eagnis dimte dulmuese feugiata lesuerleceas strices phaledaty.</p>
                  </div>
                </div>
              </article>
            </div>
            <div class="row">
              <article data-wow-delay=".4s" class="grid_6 wow fadeInRight">
                <div class="row">
                  <div class="grid_3"><img src="images/page-1_img06.jpg" alt="" class="mg-add"></div>
                  <div class="grid_3">
                    <time datetime="2015-10-11">11/10</time>
                    <h5 class="primary"><a href="#">Senanec sit aser erment dolor apegete. Cuyras esuerleceas strices phaledaty.</a></h5>
                    <p>Sepegement velu miutasase rsusen elnean ctor wisetaurna aserta. Aliam eratvpa miuyas tis ac turpis. Cinteger rutrum kertyua delertante.</p>
                  </div>
                </div>
              </article>
              <article data-wow-delay=".6s" class="grid_6 wow fadeInRight">
                <div class="row">
                  <div class="grid_3"><img src="images/page-1_img07.jpg" alt="" class="mg-add"></div>
                  <div class="grid_3">
                    <time datetime="2015-10-10">10/10</time>
                    <h5 class="primary"><a href="#">Dolouyts ta lesuerle serceas strices phaledaty fenanec site aser erment dolose.</a></h5>
                    <p>Veases dey vileacene anritma uam socis natoqu eagnis dimte dulmuese feugiata lesuerleceas strices phaledaty fenanec sit aser erment. </p>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </section>
        -->
        <!--<section class="gallery">
            <a href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img08.jpg" data-fancybox-group="1" class="thumb">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img08.jpg" alt="">
                <span class="thumb_overlay"></span>
                <span class="thumb_overlay_cnt">BEST CARIBBEAN BEACHES</span>
            </a>
            
            <a href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img09.jpg" data-fancybox-group="1" class="thumb">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img09.jpg" alt="">
                <span class="thumb_overlay"></span>
                <span class="thumb_overlay_cnt">MANUEL ANTONIO NATIONAL RESERVE</span
            </a>
            
            <a href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img10.jpg" data-fancybox-group="1" class="thumb">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img10.jpg" alt=""><span class="thumb_overlay"></span>
                <span class="thumb_overlay_cnt">GET TO TRAVEL IN LUXURY ON THE CHEAP</span>
            </a>
            
            <a href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img11.jpg" data-fancybox-group="1" class="thumb">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img11.jpg" alt="">
                <span class="thumb_overlay"></span>
                <span class="thumb_overlay_cnt">COSTA RICA IS A SLOTH PARADISE</span>
            </a>
            
            <a href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img12.jpg" data-fancybox-group="1" class="thumb">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img12.jpg" alt=""><span class="thumb_overlay"></span>
                <span class="thumb_overlay_cnt">EXPERINCE THE MOST AMAZING SUNSETS</span>
            </a>
            
            <a href="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img13.jpg" data-fancybox-group="1" class="thumb">
                <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/page-1_img13.jpg" alt=""><span class="thumb_overlay"> </span>
                <span class="thumb_overlay_cnt">VISIT THE ECO-ADVENTURE CAPITAL OF CENTRAL AMERICA</span>
            </a>
        </section>-->
        
         <section class="well bg-color1 bottom_change">
          <div class="container">
              <h2 class="center"><i class="fab fa-facebook-square"></i> Our Facebook Reviews</h2>
              <div class="mb-wrap mb-style-3 center">
            <?php echo do_action( 'wprev_pro_plugin_action', 3 ); ?>
          <!--<blockquote cite="">
            <p class="txt1 center">I had a trip of a life time touring Costa Rica. A great Thank You for such a diverse exciting, 
                wonderful, unforgettable experience. All made easy with great communication and an amazing itinerary made just for me.  
                <br>A real adventure. I would always recommend CR Vacationing as they are experts in 
                making your holiday perfect and will definitely be using them in the future...</p>
          </blockquote>-->
          <!--<div class="mb-attribution" >
            <img class="pull-right" src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/2017-07-13_1800.png" alt="">
            <p class="" style="clear: both;">Pura Vida</p>
            <!-- <div class="mb-thumb">
              <img src="images/2017-07-13_1800.png" alt="">
            </div> -->
          <!--</div>-->
        </div><br><br>
              
            <h2 class="center">BEACHES, VOLCANOS AND RAINFORESTS -COME VISIT A REAL TROPICAL PARADISE!</h2>
            <h3 class="center">Luxury Travel - Affordable Prices</h3>
            <p class="txt1 off1 center">Costa Rica is home to some of the highest rated hotels in the Americas. As we are Costa Rica Travel Hackers we will search for the best deals and get you the best prices for Luxury!</p>
            <ul class="product-list row">
              <li class="grid_4 wow fadeInLeft fade_inleft_costa"><img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/costarica_one.jpg" alt="">
                <!--<h3><a href="#">Quality Consultation</a></h3>
                <p>We are Costa Rica TRAVEL EXPERTS, our job is to make sure that your vacation in paradise is unforgettable.</p>-->
              </li>
              <li class="grid_4 wow fadeIn">
                <!--<h3><a href="#">5 Star Rated Agency - 100% Client Satisfaction</a></h3>
                <p>All of our clients have rated us 5 stars in Facebook. Schedule a call with our travel specialists and experience it yourself!</p>-->
                <img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/special_offer.jpg" alt="">
              </li>
              <li class="grid_4 wow fadeInRight"><img src="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/crystal_ballena.jpg" alt="">
                <!--<h3><a href="#">Luxury Travel for Cheap</a></h3>
                <p>We are Costa Rica Travel Hackers. We will get you the best of Costa Rica at the best price always.</p>-->
              </li>
            </ul>
            <!--<h2 class="center">What our customer say?</h2>-->

<!--             <p class="txt1 center">
    I had a trip of a life time touring Costa Rica. A great Thank You for such a diverse exciting, 
    wonderful, unforgettable experience. All made easy with great communication and an amazing itinerary made just for me.  
    <br>A real adventure. I would always recommend CR Vacationing as they are experts in 
    making your holiday perfect and will definitely be using them in the future...
   <br><br><b>-Pura Vida</b></p> -->
            
          </div>
        </section>
        
        <section data-url="<?php bloginfo('stylesheet_directory'); ?>/adventure_costa/images/parallax1.jpg" data-mobile="true" class="well3 center parallax">
            <div class="parallax_image"></div>
          <div class="parallax_cnt">
          <h2>EXPLORE PARADISE WITH US!</h2>
          <h3>WE ARE EXPERTES IN NATURE TRAVEL, FAMILY VACATIONS, HONEYMOONS AND MORE!</h3><a href="#" class="btn">BEGIN YOUR ADVENTURE!</a>
        </div>
        </section>
      </main>
      <!--
      ========================================================
      							FOOTER
      ========================================================
      -->
      <!--<footer class="mobile-center">
        <div class="container">
          <div class="row">
            <div class="grid_2">
              <ul class="inline-list">
                <li><a href="https://www.facebook.com/CRVacationing/" class="fa-facebook"></a></li>
              </ul>
            </div>
            <div class="grid_2">
              <address>San Jose, <br>Costa Rica</address>
            </div>
            <div class="grid_8"><a href="mailto:vacaysupport@crvacationing.com" class="fa-envelope">vacaysupport@crvacationing.com</a>
              <div class="copyright"> © <span id="copyright-year">2019</span> | Costa Rica Vacationing All rights Reserved</div><!-- {%FOOTER_LINK} -->
           <!-- </div>
          </div>
        </div>
      </footer>-->
    </div>
  
  <script type="text/javascript">
/*function openFun() 
{
	var fullname = document.getElementById("fullname").value;
	var email = document.getElementById("email").value;
	var slct = document.getElementById("slct").value;

	if(fullname=="")
	{
	    alert("please enter your name);
	    return false;
	}
	else if(email=="")
	{
	    alert("please enter your email");
	    return false;
	}
	else if(slct=="")
	{
	    alert("please fill tour from dropdown!");
	    return false;
	}
	else
	{
        return true;
	}
}*/

</script>
   
<?php get_footer(); 