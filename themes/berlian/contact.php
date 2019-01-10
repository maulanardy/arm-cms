<?php 
$guestBook = new GuestBook\Main();

include('header.php');
?>
<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-contact" data-active-page-slug="contact" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h2 class="h1 text-danger m0">Contact Us</h2>
        </div>
        <div class="col-md-4 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="index.html" class="text-danger">HOME</a></li>
            <li>CONTACT US</li>
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
            <h1 class="page-title text-danger title half-bordered m0">Contact Us</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix">
      <div class="container">
        <div class="row matchHeight">
          <div class="col-sm-8 item mb30">
            <form method="POST" action=""  class="contact-form p35 p15-sm">
              <div class="form-horizontal">
                  <?php
                  if($userController->isLogin()) $user = $userController->logedUser();

                  $submit_name   = $userController->isLogin() ? $user->name : "";
                  $submit_email  = $userController->isLogin() ? $user->email : "";
                  $submit_phone  = $userController->isLogin() ? $user->phone : "";

                  echo \helper::flashdata("successSubmit");

                  if(isset($_POST["submit"])){
                    if($guestBook->register()){
                      header("Location: ".BASE."contact");
                    }
                    echo validation::error_message();

                    $submit_name   = helper::getParam('name');
                    $submit_email  = helper::getParam('email');
                    $submit_phone  = helper::getParam('phone');
                    $submit_company  = helper::getParam('company');
                    $submit_messages  = helper::getParam('messages');
                  }
                  ?>
                <div class="form-group">
                  <div class="col-md-6 mb15-md">
                    <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $submit_name?>">
                  </div>
                  <div class="col-md-6">
                    <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $submit_email?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6 mb15-md">
                    <input type="text" name="phone" placeholder="Phone" class="form-control" value="<?php echo $submit_phone?>">
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="company" placeholder="Company" class="form-control" value="<?php echo $submit_company?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <textarea rows="5" name="messages" placeholder="Write Your Message" class="form-control"><?php echo $submit_messages?></textarea>
              </div>
              <div class="form-group m0">
                <button type="submit" name="submit" value="submit" class="btn btn-danger btn-lg">SUBMIT</button>
              </div>
            </form>
          </div>
          <div class="col-sm-4 item mb30">
            <address>
              <strong><?php echo Ma\Controller\Setting\Main::get("company_name")?></strong><br>
              <?php echo Ma\Controller\Setting\Main::get("address_1")?><br>
              <?php echo Ma\Controller\Setting\Main::get("address_2")?><br>
              <abbr title="Phone">Phone:</abbr> <?php echo Ma\Controller\Setting\Main::get("telp")?><br>
              <abbr title="Phone">Email:</abbr> <?php echo Ma\Controller\Setting\Main::get("default_email")?>
            </address>
            <div class="embed-responsive embed-responsive-4by3">
              <?php echo Ma\Controller\Setting\Main::get("maps_widget")?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<?php include('footer.php');?>