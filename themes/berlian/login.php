<?php 
$eventController = new Event\Main();

include('header.php');
?>
<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-reg" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
            <li>LOGIN</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <div class="clearfix content pv60 mv60 pt0-sm">
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="page-title text-danger title half-bordered m0">Login</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <form method="POST" action="" class="reg-form p35 20-sm">
              <?php
              if(Io::param('login')){
                  $userController->login();
              }

              if($userController->isLogin()){
                  header('Location: '.BASE);
              }

              echo $userController->error;
              echo \helper::flashdata("errorLogin");
              ?>
              <div class="row">
                <div class="col-md-8 text-center">
                  <div class="form-group">
                    <input type="email" name="email" placeholder="Your Email" required class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="submit" name="login" value="SIGN IN" class="btn btn-danger btn-lg btn-block">
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-white">
                <p class="m0">Or please <a href="<?php echo BASE?>register" class="text-danger">Register </a>if you are not yet registered</p>
              </div>
            </form>
          </div>
          <div class="col-sm-4 mb30">
            <aside class="post">
              <div class="panel clean widget mb30">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="title text-black mt0">Upcoming Events</h4>
                    </div>
                  </div>
                  <div class="row panel-wrap">
                    <div class="item col-md-12 col-xs-12 p0-xs">
                      <?php foreach ($eventController->getNextEvent(1) as $key => $value) { ?>

                      <a href="<?php echo BASE.'event/'.$value->category->slug.'/'.$value->slug?>" class="panel block mb0-xs" style="text-decoration: none;">
                        <figure class="panel-body p10"><img src="<?php echo THUMBS.'_369x252/'.$value->featured_image?>" class="mb10">
                          <figcaption>
                            <h5 class="text-black title m0"><?php echo $eventController->Detail->getTitle($value->id, 1)?></h5>
                            <p class="text-muted m0"><em><?php echo $value->start_date->format("d F Y")?> - <?php echo $value->end_date->format("d F Y")?></em></p>
                            <p class="text-danger m0">READ MORE</p>
                          </figcaption>
                        </figure>
                      </a>

                      <?php }?>
                    </div>
                  </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<?php include('footer.php');?>