<?php 
$instagram = new \Instagram\Main(IG_TOKEN);
$instagram->setLimit(7);
?>
      <div id="login" style="display:none;" class="login-popup">
        <form method="POST" class="contact-form p60 p30-sm">
          <?php
          if(Io::param('login')){
              if($userController->login()){
                header("Location: ".DOMAIN.$_SERVER[REQUEST_URI]);
              } else {
                header("Location: ".BASE."login");
              }
          }
          ?>
          <!-- -->
          <div class="form-group text-center">
            <h1 class="m0">Sign In</h1>
          </div>
          <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" required class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" required class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="login" value="SIGN IN" class="btn btn-danger btn-lg btn-block">
          </div>
          <hr>
          <div class="text-center text-white">
            <p class="m0">Or please <a href="<?php echo BASE?>register" class="text-danger">Register </a>if you are not yet registered</p>
          </div>
        </form>
      </div>
      <div style="border: #00000052 solid 1px;" class="notif-card bottom pv10 ph15">
        <div class="caption pll0 ml50">
          <h4 style="color: #950603;" class="m0">John Doe</h4>
          <p class="m0">Recently Book a ticket</p>
        </div>
      </div>
      <section class="clearfix thumbs-inline">
        <div id="footer-thumbs" class="wrap as-table">
              <?php 
              // if($instagram->getRecentPost()){
              if(1 == 2){
                foreach ($instagram->data as $key => $value) { 
              ?>
          <a href="<?php echo BASE?>instagram?url=<?php echo $value->link?>" data-fancybox data-type="iframe" style="background-image: url(<?php echo $value->images->low_resolution->url?>)" class="thumbnail img-cover"></a>
              <?php
                }
              } else {
                echo $instagram->error;
              }
              ?>
        </div>
      </section>
      <section style="background-image: url(<?php echo THEMES?>assets/images/repository/bg-follow-ins.jpg)" class="clearfix img-cover follow-insta pv35">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <h4 class="subtitle text-white m0">Follow us on INSTAGRAM</h4><a href="https://www.instagram.com/berlianentertainment/" target="_blank" class="btn-link text-white">@berlianentertainment</a>
            </div>
          </div>
        </div>
      </section>
      <section class="clearfix email-reg pv35">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-md-push-2 text-center">
              <h4 class="subtitle mt0 mb30">Sign up to receive all the latest updates &amp; news from Berlian Entertainment</h4>
              <form>
                <div class="form-group placeholder-animate mb5">
                  <div class="input-group">
                    <label class="text-danger m0">Type your email here</label>
                    <input id="text_subscribe" type="text" class="form-control p0">
                    <div class="input-group-btn">
                      <button id="btn_subscribe" data-base="<?php echo BASE?>" type="submit" class="btn btn-danger">Sign Up</button>
                    </div>
                  </div>
                </div>
                <div class="form-group text-left"><small class="help-block">No worries,we hate spam too.</small></div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <footer class="footer">
        <div class="container text-center pv20">
          <ol class="foot-socmed list-inline">
            <li><a href="<?php echo Ma\Controller\Setting\Main::get("facebook")?>" target="_blank"><span class="fa fa-facebook"></span></a></li>
            <li><a href="<?php echo Ma\Controller\Setting\Main::get("twitter")?>" target="_blank"><span class="fa fa-twitter"></span></a></li>
            <li><a href="<?php echo Ma\Controller\Setting\Main::get("instagram")?>" target="_blank"><span class="fa fa-instagram"></span></a></li>
            <li><a href="<?php echo Ma\Controller\Setting\Main::get("youtube")?>" target="_blank"><span class="fa fa-youtube-play"></span></a></li>
          </ol>
          <p><small>&copy; 2018 All Rights Reserved Berlian Entertainment</small></p>
          <nav class="foot-nav">
            <ol class="list-inline m0">
              <?php echo $ARM->menu->bottom_menu?>
            </ol>
          </nav>
        </div>
      </footer>
      
    </div>
    <script src="<?php echo THEMES?>assets/scripts/libs.js" type="text/javascript"></script>
    <script src="<?php echo THEMES?>assets/scripts/global.js" type="text/javascript"></script>
    <script src="<?php echo THEMES?>assets/scripts/dev.js" type="text/javascript"></script>
  </body>
</html>