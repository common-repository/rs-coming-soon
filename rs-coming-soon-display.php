  <?php wp_head(); ?>

  <!DOCTYPE HTML>
  <!--[if lt IE 7 ]> <html lang="en" class="ie ie6"> <![endif]--> 
  <!--[if IE 7 ]> <html lang="en" class="ie ie7"> <![endif]--> 
  <!--[if IE 8 ]> <html lang="en" class="ie ie8"> <![endif]--> 
  <!--[if IE 9 ]> <html lang="en" class="ie ie9"> <![endif]--> 
  <!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
  
  <head>
    <meta charset="utf-8">
    <title><?php echo get_bloginfo( 'name' ); ?></title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold"> 

  </head>

  <body>


  <div class="main_area">

    <div class="rs_sky">


    <div class="rs_moon"></div>
    <div class="rs_clouds_one"></div>
    <div class="rs_clouds_two"></div>
    <div class="rs_clouds_three"></div>

      <section class="rs_main">


        <div class="text_bg">
        <div id="rs_content" class="wrapper topSection">
          <div id="rs_header">
            <div class="rs_wrapper">
              <div class="logo"><h1><?php echo cs_get_option( 'rs_name' ); ?></h1> </div>
            </div>
          </div>
          <h2><?php echo cs_get_option( 'rs_title' ); ?></h2>  
          <!-- <div class="countdown styled"></div> -->

          <h3><?php echo cs_get_option( 'rs_subs_title' ); ?></h3>

        </div>
        </div>
      </section>


      <section class="rs_subscribe">
        <div class="container">
          <div id="rs_subscribe">
            


        <?php echo rs_subs_form(); ?>


  <!--   <form action="" method="post" onsubmit="">
      <p><input name="rscs_email" required placeholder="Enter your e-mail" type="email" id=""/>
      <input type="submit" value="Submit"/></p>
    </form> -->
  

    <div id="socialIcons">
      <ul> 
        <li><a href="<?php echo cs_get_option( 'rs_twitter' ); ?>" title="Twitter" class="twitterIcon"></a></li>
        <li><a href="<?php echo cs_get_option( 'rs_facebook' ); ?>" title="facebook" class="facebookIcon"></a></li>
        <li><a href="<?php echo cs_get_option( 'rs_linkedin' ); ?>" title="linkedIn" class="linkedInIcon"></a></li>
        <li><a href="<?php echo cs_get_option( 'rs_pinterest' ); ?>" title="Pintrest" class="pintrestIcon"></a></li>
      </ul>
    </div>
  </div>
</div>
</section>


<?php wp_footer(); ?>

  </div>

</div>



</body>
</html>
