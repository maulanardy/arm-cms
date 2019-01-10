<?php 
$eventController = new Event\Main();
$downloadController = new Download\Main();

$post = $ARM->posts->retrieve(Io::param("id"));

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
            <li>DOWNLOAD FORM</li>
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
            <h1 class="page-title text-danger title half-bordered m0">Download Form</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <form method="POST" action="" class="reg-form p35 20-sm">
              <div class="row">
                <div class="col-md-8">
                  <?php
                  if($userController->isLogin()) $user = $userController->logedUser();

                  $submit_name   = $userController->isLogin() ? $user->name : "";
                  $submit_email  = $userController->isLogin() ? $user->email : "";
                  $submit_phone  = $userController->isLogin() ? $user->phone : "";

                  if(isset($_POST["submit"])){
                    if($downloadController->register()){
                      $file_url = $post->document;
                      header('Content-Type: application/octet-stream');
                      header("Content-Transfer-Encoding: Binary"); 
                      header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
                      readfile($file_url);
                    }
                    echo validation::error_message();

                    $submit_name   = helper::getParam('name');
                    $submit_email  = helper::getParam('email');
                    $submit_phone  = helper::getParam('phone');
                    $submit_company  = helper::getParam('company');
                  }
                  ?>
                  <div class="form-group">
                    <input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $submit_name?>">
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Your Email" class="form-control" name="email" value="<?php echo $submit_email?>">
                  </div>
                  <div class="form-group">
                    <input type="tel" placeholder="Phone" class="form-control" name="phone" value="<?php echo $submit_phone?>">
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Company" class="form-control" name="company" value="<?php echo $submit_company?>">
                  </div>
                  <div class="form-group mb0">
                    <input type="submit" name="submit" value="Download" class="btn btn-danger btn-lg">
                  </div>
                </div>
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