<?php 
$eventController = new Event\Main();
$artistController = new ArtistWishlist\Main();
$answerController = new ArtistWishlist\Answer();

$artist = $artistController->getActive();    

if(!$userController->isLogin()){
  header("Location: ".BASE."login");
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
            <li>WISHLIST</li>
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
            <h1 class="page-title text-danger title half-bordered m0">Wishlist</h1>
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
                  echo \helper::flashdata("successVote");

                  if(isset($_POST["vote"])){
                    if($userController->isLogin()){
                      if($answerController->save()){
                        header("Location: ".BASE."wishlist");
                      }

                      echo '<div class="alert alert-danger">'.$answerController->error_msg.'</div>';
                    }
                  }

                  if(isset($_POST["suggest"])){
                    if($userController->isLogin()){
                      if($artistController->insert()){
                        header("Location: ".BASE."wishlist");
                      }

                      echo '<div class="alert alert-danger">'.$artistController->error_msg.'</div>';
                    }
                  }
                  ?>
                  <div class="form-group">
                    <select class="form-control" name="artist" required="required">
                      <option>-- Select Artist --</option>
                      <?php foreach ($artist as $key => $value) {
                         echo '<option value="'.$value->id.'" '.(Io::param("artist") == $value->id ? "selected":"").'>'.$value->name."</option>";
                      }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="vote" class="btn btn-danger btn-lg">Vote</button>
                  </div>
                  <p>OR</p>
                  <div class="form-group">
                    <input type="text" placeholder="Suggest your Artist name" class="form-control" name="name" value="<?php echo Io::param("name")?>">
                  </div>
                  <div class="form-group mb0">
                    <button type="submit" name="suggest" class="btn btn-danger btn-lg">Suggest</button>
                  </div>
                </div>
              </div>
            </form>

            <h2 class="text-danger title half-bordered m0 mt30">Result</h2>
            <?php
            $totalvote = 0;
            foreach ($artist as $k => $v) { $totalvote += count($v->answer); }
            foreach ($artist as $k => $v) { 
              $vote = round(count($v->answer) * 100 / $totalvote);
            ?>
              <span><?php echo $v->name?> <?php echo $vote?>%</span>
              <div class="progress polling">
                <div class="vote progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo count($v->answer) . "-" . $totalvote?>"
                aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $vote?>%; line-height: 38px;"><span><?php echo $vote?>%</span></div>
              </div>
            <?php } ?>
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