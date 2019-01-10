<?php 
$eventController = new Event\Main();

if($userController->isLogin()){
    header('Location: '.BASE);
}

if(isset($_POST["submit"])){
  if($userController->register()){
    header("Location: ".BASE);
  }
}

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
            <li>REGISTER</li>
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
            <h1 class="page-title text-danger title half-bordered m0">Register</h1>
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
                  echo validation::error_message();
                  ?>
                  <div class="form-group">
                    <input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo helper::getParam('name')?>">
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Your Email" class="form-control" name="email" value="<?php echo helper::getParam('email')?>">
                  </div>

                  <div class="form-group">
                    <label>Gender</label>
                    
                    <div class="">
                      <label>
                        <input type="radio" name="gender" id="male" value="male" checked required="required">
                        Male
                      </label>
                      <label>
                        <input type="radio" name="gender" id="female" value="female" <?php echo Io::param("gender") == "female" ? "checked" : ""?> required="required">
                        Female
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="first">Date of Birth</label>
                      <div class="form-inline">
                        <select class="form-control" name="dob_date" required="required">
                          <?php 
                          $day = Io::param("dob_date");
                          $month = Io::param("dob_month");
                          $year = Io::param("dob_year");
                          ?>
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
                    <input type="tel" placeholder="Phone" class="form-control" name="phone" value="<?php echo helper::getParam('phone')?>">
                  </div>
                  <div class="form-group">
                    <input type="password" placeholder="Type Your Password" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                    <input type="password" placeholder="Re-Type Your Password" class="form-control" name="repassword">
                  </div>
                  <div class="form-group mb0">
                    <input type="submit" name="submit" value="REGISTER" class="btn btn-danger btn-lg">
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-center text-white">
                <p class="m0">Already have an Account? You can  <a href="<?php echo BASE?>login" class="text-danger">login here</a></p>
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