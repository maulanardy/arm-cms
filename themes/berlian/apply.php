<?php 
$eventController = new Event\Main();
$applyController = new Apply\Main();


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
            <li>APPLY</li>
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
            <h1 class="page-title text-danger title half-bordered m0">Apply</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <form method="POST" action="" enctype="multipart/form-data" class="reg-form p35 20-sm">
              <input type="hidden" name="user_id" value="<?php echo $userController->isLogin() ? $userController->id : 0?>">
              <div class="row">
                <div class="col-md-8">
                  <?php
                  if($userController->isLogin()) $user = $userController->logedUser();

                  $submit_name   = $userController->isLogin() ? $user->name : "";
                  $submit_email  = $userController->isLogin() ? $user->email : "";
                  $submit_gender = $userController->isLogin() ? $user->gender : "";
                  $day           = $userController->isLogin() ? $user->birth_date->format("d") : "";
                  $month         = $userController->isLogin() ? $user->birth_date->format("m") : "";
                  $year          = $userController->isLogin() ? $user->birth_date->format("Y") : "";
                  $submit_phone  = $userController->isLogin() ? $user->phone : "";
                  echo \helper::flashdata("successApply");

                  if(isset($_POST["submit"])){
                    if($applyController->register()){
                      header("Location: ".BASE."apply/?post_id=".Io::param("post_id"));
                    }

                    echo '<div class="alert alert-danger">'.$applyController->error_msg.'</div>';
                    echo validation::error_message();

                    $submit_name   = helper::getParam('name');
                    $submit_email  = helper::getParam('email');
                    $submit_gender = helper::getParam('gender');
                    $day           = Io::param("dob_date");
                    $month         = Io::param("dob_month");
                    $year          = Io::param("dob_year");
                    $submit_phone  = helper::getParam('phone');
                  }
                  ?>
                  <div class="form-group">
                    <input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $submit_name?>">
                  </div>
                  <div class="form-group">
                    <input type="email" placeholder="Your Email" class="form-control" name="email" value="<?php echo $submit_email?>">
                  </div>

                  <div class="form-group">
                    <label>Gender</label>
                    
                    <div class="">
                      <label>
                        <input type="radio" name="gender" id="male" value="male" checked required="required">
                        Male
                      </label>
                      <label>
                        <input type="radio" name="gender" id="female" value="female" <?php echo $submit_gender == "female" ? "checked" : ""?> required="required">
                        Female
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="first">Date of Birth</label>
                      <div class="form-inline">
                        <select class="form-control" name="dob_date" required="required">
                          <?php for ($i=1; $i <= 31; $i++) {
                             echo '<option value="'.$i.'" '.($i == $day ? 'selected' : '').'>'.$i."</option>";
                          }?>
                        </select>
                        <select class="form-control" name="dob_month" required="required">
                          <?php foreach (helper::month_name("eng") as $key => $value) {
                             echo '<option value="'.($key+1).'" '.($key+1 == $month ? 'selected' : '').'>'.$value."</option>";
                          }?>
                        </select>
                        <select class="form-control" name="dob_year" required="required">
                          <?php for ($i=date("Y") - 45; $i <= date("Y") - 18; $i++) {
                             echo '<option value="'.$i.'" '.($i == $year ? 'selected' : '').'>'.$i."</option>";
                          }?>
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <input type="tel" placeholder="Phone" class="form-control" name="phone" value="<?php echo $submit_phone?>">
                  </div>
                  <div class="form-group">
                    <label>Resume</label>
                    <input type="file" class="form-control" name="resume"">
                  </div>
                  <div class="form-group mb0">
                    <button type="submit" name="submit" class="btn btn-danger btn-lg">REGISTER</button>
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