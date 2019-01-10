<?php 
$eventController = new Event\Main();
$installmentController = new Installment\Main();

$programList = $installmentController->getActive();

if(Io::param("program_id")){
  $program = $installmentController->getById(Io::param("program_id"));
} else {
  $program = $programList[0];
}

include('header.php');
?>
<style type="text/css">
  .form-group label {
    color: #FFF;
    vertical-align: middle;
    display: inline;
    text-align: right;
    /* float: right; */
    height: 29px;
}

.form-group .form-label {
    text-align: right;
}
</style>
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
            <li>INSTALLMENT</li>
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
            <h1 class="page-title text-danger title half-bordered m0">PROGRAM MERDEKA<br>CICILAN #HargaTakkanTerganti</h1>
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
                  $submit_phone  = $userController->isLogin() ? $user->phone : "";

                  echo \helper::flashdata("successApply");

                  if(isset($_POST["apply"])){
                    if($installmentController->register()){
                      header("Location: ".BASE."installment");
                    }

                    echo '<div class="alert alert-danger">'.$installmentController->error_msg.'</div>';
                    echo validation::error_message();

                    $submit_term            = helper::getParam('term');
                    // $submit_bank         = helper::getParam('bank');
                    // $submit_bank_account = helper::getParam('bank_account');
                    // $submit_bank_number  = helper::getParam('bank_number');
                    $submit_name            = helper::getParam('name');
                    $submit_email           = helper::getParam('email');
                    $submit_phone           = helper::getParam('phone');
                    // $submit_address      = helper::getParam('address');
                    $submit_ktp             = helper::getParam('ktp');
                  }
                  ?>
                  <div class="form-group row">
                    <div class="col-md-4 form-label"><label>KATEGORI TIKET</label></div>
                    <div class="col-md-8"><select class="form-control" id="installment_program" name="installment_id" required="required">
                      <?php foreach ($programList as $key => $value) {
                         echo '<option data-url="'.BASE.'installment?program_id='.$value->id.'" value="'.$value->id.'" '.($program->id == $value->id ? 'selected' : '').'>'.$value->name." - Rp ".number_format($value->price,0,",",".").",-</option>";
                      }?>
                    </select></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4 form-label"><label>CICILAN, 2X BAYAR</label></div>
                    <div class="col-md-8"><input type="text" readonly="readonly" class="form-control" name="term" value="Pembayaran Pertama - Rp <?php echo number_format(ceil($program->price / 2),0,",",".")?>,-" required="required"></div>
                  </div>
                  <?php /*
                  <!--Program Installment-->
                  <div class="form-group">
                    <select class="form-control" name="term" required="required">
                      <option value="">-- Payment Terms --</option>
                      <?php for ($i=1; $i <= $program->max_term; $i++) {
                         echo '<option value="'.$i.'" '.($i == $submit_term ? 'selected' : '').'>'.$i.' Month @'.number_format(ceil($program->price / $i)).'</option>';
                      }?>
                    </select>
                  </div> */ ?>
                 <?php /* <div class="form-group">
                    <select class="form-control" name="bank" required="required">
                      <option value="">-- Select Bank --</option>
                      <option value="BCA" <?php echo $submit_bank == "BCA" ? "selected" : ""?>>BCA</option>
                      <option value="BNI" <?php echo $submit_bank == "BNI" ? "selected" : ""?>>BNI</option>
                      <option value="BRI" <?php echo $submit_bank == "BRI" ? "selected" : ""?>>BRI</option>
                      <option value="Bukopin" <?php echo $submit_bank == "Bukopin" ? "selected" : ""?>>Bukopin</option>
                      <option value="CIMB" <?php echo $submit_bank == "CIMB" ? "selected" : ""?>>CIMB</option>
                      <option value="Citibank" <?php echo $submit_bank == "Citibank" ? "selected" : ""?>>Citibank</option>
                      <option value="Danamon" <?php echo $submit_bank == "Danamon" ? "selected" : ""?>>Danamon</option>
                      <option value="HSBC" <?php echo $submit_bank == "HSBC" ? "selected" : ""?>>HSBC</option>
                      <option value="Mandiri" <?php echo $submit_bank == "Mandiri" ? "selected" : ""?>>Mandiri</option>
                      <option value="Maybank" <?php echo $submit_bank == "Maybank" ? "selected" : ""?>>Maybank</option>
                      <option value="OCBC" <?php echo $submit_bank == "OCBC" ? "selected" : ""?>>OCBC</option>
                      <option value="Panin" <?php echo $submit_bank == "Panin" ? "selected" : ""?>>Panin</option>
                      <option value="Permata" <?php echo $submit_bank == "Permata" ? "selected" : ""?>>Permata</option>
                      <option value="UOB" <?php echo $submit_bank == "UOB" ? "selected" : ""?>>UOB</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Bank Account Name" class="form-control" name="bank_account" value="<?php echo $submit_bank_account?>" required="required">
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Bank Account Number" class="form-control" name="bank_number" value="<?php echo $submit_bank_number?>" required="required">
                  </div>*/ ?>
                  <div class="form-group row">
                    <div class="col-md-4 form-label"><label>NAMA</label></div>
                    <div class="col-md-8"><input type="text" placeholder="Nama" class="form-control" name="name" value="<?php echo $submit_name?>" required="required"></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4 form-label"><label>EMAIL</label></div>
                    <div class="col-md-8"><input type="email" placeholder="Email" class="form-control" name="email" value="<?php echo $submit_email?>" required="required"></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4 form-label"><label>NO. WHATSAPP</label></div>
                    <div class="col-md-8"><input type="tel" placeholder="No. Whatsapp" class="form-control" name="phone" value="<?php echo $submit_phone?>" required="required"></div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4 form-label"><label>NO. ID / KTP</label></div>
                    <div class="col-md-8"><input type="text" placeholder="No. ID / KTP" class="form-control" name="ktp" value="<?php echo $submit_ktp?>" required="required"></div>
                  </div>
                  <?php /*
                  <div class="form-group">
                    <textarea class="form-control" placeholder="Address" name="address" required="required"><?php echo $submit_address?></textarea>
                  </div>*/ ?>
                  <div class="form-group mb0">
                    <button type="submit" name="apply" class="btn btn-danger btn-lg" required="required">APPLY</button>
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