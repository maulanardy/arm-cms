<?php 
$eventController  = new Event\Main();

$banner = $ARM->media->findBySlugCategory('main-banner');
$event = $eventController->getNextEvent(6);
$pastEvent = $eventController->getPastEvent(6);
$news  = $ARM->posts->getFeatured('news', 2);
$video  = $ARM->posts->getFeatured('video', 3);

if(isset($_POST["book"])){
  $e = $eventController->getById($_POST["select_event"]);
  header("Location: ".BASE."event_visitor/?event_id=".$_POST["select_event"]."&event_url=".$e->ticket_url);
}

include('header.php');
?>
<main role="main" style="background-image:url(<?php echo THEMES?>assets/images/repository/bg-hero-1.jpg)" class="body">
  <div id="page-info" data-name="p-home" data-active-page-slug="home" data-menu-target="#top-nav"></div>
  <section class="clearfix home-hero">
    <div class="home-slide">
    <?php foreach ($banner as $key => $value) { ?>
      <figure style="background-image:url(<?php echo UPLOAD.$value->file?>)" class="slide">
      <a style="color: inherit; " target="<?php echo $value->url == "#" ? "_self" : "_blank"?>" href="<?php echo $value->url?>">
        <figcaption class="valign-middle by-transform">
          <div class="container">
            <div class="row">
              <div class="col-md-5">
                <hgroup>
                  <h2 class="title m0"><?php echo $value->title?></h2>
                  <h4 class="subtitle m0"><?php echo $value->content?></h4>
                </hgroup>
                <div class="slide-controls"></div>
              </div>
            </div>
          </div>
        </figcaption>
      </a>
      </figure>
    <?php }?>
    </div>
  </section>
  <section class="clearfix events">
    <div class="container red-square">
      <div class="arrow-prevnext">
        <div class="btn prev"><i class="fa fa-angle-left"></i></div>
        <div class="btn next"><i class="fa fa-angle-right"></i></div>
      </div>
      <div class="row comenjoin mb60 pb60">
        <div class="col-md-12 text-center">
          <h2 class="mt0 mb30">COME N JOIN</h2>
          <form method="POST">
            <select name="select_event" class="selectpicker select-event">
              <option>Pilih Event</option>
              <?php foreach ($event as $key => $value) {?>
              <option value="<?php echo $value->id?>"><?php echo $eventController->Detail->getTitle($value->id, 1)?></option>
              <?php }?>
            </select>
            <?php if(!$userController->isLogin()){?>
            <a href="#login" data-fancybox class="btn btn-white btn-lg ml15 popup-login"><span>BUY NOW</span></a>
            <?php } else {?>
            <button type="submit" name="book" value="book" class="btn btn-white btn-lg ml15"><span>BUY NOW</span></button>
            <?php }?>
          </form>
        </div>
      </div>
      <div class="row pastnext">
        <div class="col-md-12">
          <header class="text-center">
            <ul id="pastnext-tab" class="nav nav-tabs mb20">
              <li><a href="#past" id="btn-past">PAST</a></li>
              <li><a href="#next" id="btn-next">NEXT</a></li>
            </ul>
            <h1 class="mt0 mb50">EVENTS</h1>
          </header>
          <div class="tab-content">
            <div id="past" class="tab-pane fade in"><div class="innertab-carousel">
              <?php foreach ($pastEvent as $key => $value) {?>

              <div class="slide p0 mh15 pt30">
                <a href="<?php echo BASE?>event-past/<?php echo $value->category->slug."/".$value->slug?>">
                  <div class="media">
                    <div class="media-left pr20"><strong class="day m0"><?php echo $value->start_date->format("d")?></strong></div>
                    <div class="media-body">
                      <p class="date text-2nd m0"><?php echo strtoupper($value->start_date->format("F Y"))?></p>
                      <h3 class="m0"><?php echo $eventController->Detail->getTitle($value->id, 1)?></h3>
                      <p class="m0"><?php echo $value->location?></p>
                    </div>
                  </div>
                </a>
              </div>

              <?php }?></div>
            </div>
            <div id="next" class="tab-pane fade active in"><div class="innertab-carousel">
              <?php foreach ($event as $key => $value) {?>

              <div class="slide p0 mh15 pt30">
                <a href="<?php echo BASE?>event/<?php echo $value->category->slug."/".$value->slug?>">
                  <div class="media">
                    <div class="media-left pr20">
                      <?php if($value->id != 7){?><strong class="day m0"><?php echo $value->start_date->format("d")?></strong>
                    <?php }?></div>
                    <div class="media-body">
                      <p class="date text-2nd m0"><?php echo strtoupper($value->start_date->format("F Y"))?></p>
                      <h3 class="m0"><?php echo $eventController->Detail->getTitle($value->id, 1)?></h3>
                      <p class="m0"><?php echo $value->location?></p>
                    </div>
                  </div>
                </a>
              </div>

              <?php }?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container ourvideo">
      <svg style="height: 0;width: 0;">
        <defs>
          <clipPath id="clip-square" clipPathUnits="objectBoundingBox">
            <polygon fill="none" points=".5,0 1,.5 .5,1 0,.5"></polygon>
          </clipPath>
        </defs>
      </svg>
      <div class="row">
        <div class="col-md-12">
          <header class="text-center">
            <h1 class="m0">Our Video</h1>
          </header>
        </div>
        <div id="ourvideo-thumbs" class="col-md-12 thumbs">

          <?php foreach ($video as $key => $value) { ?>
          <a href="https://www.youtube.com/embed/<?php echo $value->youtube?>" data-fancybox="gallery" style="background-image: url(https://img.youtube.com/vi/<?php echo $value->youtube?>/hqdefault.jpg)" class="thumbnail nth-<?php echo $key + 1?>">
            <div class="valign-middle by-table ph60"><i class="block fa fa-play-circle"></i><span class="block caption"><?php echo Io::excerpt($ARM->posts->Detail->getTitle($value->id, 1), 40)?></span></div></a>
          <?php }?>

        </div>

        <div class="col-md-12 ourvideo-slides">

          <?php foreach ($video as $key => $value) { ?>
          <div class="slide"><a href="https://www.youtube.com/embed/<?php echo $value->youtube?>" data-fancybox="gallery" style="background-image: url(https://img.youtube.com/vi/<?php echo $value->youtube?>/hqdefault.jpg)" class="thumbnail">
              <div class="valign-middle by-table"><i class="block fa fa-play-circle"></i><span class="block caption"><?php echo Io::excerpt($ARM->posts->Detail->getTitle($value->id, 1), 40)?></span></div></a></div>
          <?php }?>

        </div>
        <div class="col-md-12 ourvideo-more"><a href="<?php echo BASE?>video" style="background-image: url(<?php echo THEMES?>assets/images/repository/bg-square.jpg)" class="thumbnail">
            <div class="valign-middle by-table"><span class="caption">More Video</span></div></a></div>
      </div>
    </div>
    <div class="bg-red"></div>
    <div class="bg-dark"></div>
  </section>
  <section class="clearfix news mt60 pv60">
    <div class="container">
      <div class="row mb60">
        <div class="col-md-12">
          <header class="text-center">
            <h1 class="text-danger m0">News</h1>
          </header>
        </div>
      </div>
      <div class="row">
        <?php foreach ($news as $key => $value) { ?>

        <div class="col-md-6">
          <figure><img src="<?php echo THUMBS."_369x252/".$value->featured_image?>" alt="">
            <figcaption><a href="<?php echo BASE.$value->category->slug.'/'.$value->slug?>" class="block">
                <hgroup>
                  <h5 class="subtitle m0"><?php echo strtoupper($ARM->postsCategory->Detail->getTitle($value->category->id, 1))?></h5>
                  <h3 class="title m0"><?php echo Io::excerpt($ARM->posts->Detail->getTitle($value->id, 1), 40)?></h3>
                </hgroup>
                <div class="text-more text-right"><i class="fa fa-angle-right mr5"></i><em class="text-muted">Read more</em></div></a></figcaption>
          </figure>
        </div>

        <?php }?>
      </div>
    </div>
  </section>
</main>


<?php include('footer.php');?>