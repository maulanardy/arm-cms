<?php
$related = $event->getRelated(explode(",", $post->tags), 4);
$title = $event->Detail->getTitle($post->id, 1);
$header = $title;
$keywords = $post->tags;
$description = strtolower($event->Detail->getExcerpt($post->id, 1));
$ogimg = UPLOAD.$post->featured_image;
$categoryTitle = ucfirst(strtolower($event->Category->Detail->getTitle($category->id)));


include('header.php'); 
?>

<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-event" data-active-page-slug="event" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2 class="h1 text-danger m0"><?php echo $categoryTitle?></h2>
        </div>
        <div class="col-md-8 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
            <li><a href="<?php echo BASE?>event" class="text-danger">EVENT</a></li>
            <li><a href="<?php echo BASE.'event/'.$category->slug?>" class="text-danger"><?php echo strtoupper($categoryTitle)?></a></li>
            <li><?php echo Io::excerpt($title,60);?></li>
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
            <h2 class="page-title text-danger title half-bordered m0"><?php echo $title?></h2>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 mb30">
            <article><img src="<?php echo UPLOAD.$post->featured_image?>" alt="<?php echo $title?>" class="mb30">
                <?php echo $event->Detail->getContent($post->id, 1)?>
            </article>
          </div>
          <div class="col-sm-4 mb30">
            <aside>
              <div class="panel clean widget mb30">
                <?php if($post->id == 8){?>
                <div class="panel-body p0"><a href="<?php echo BASE?>installment"  class="btn btn-danger btn-lg btn-block">BOOK NOW</a></div>
                <?php } else if(!$userController->isLogin()){?>
                <div class="panel-body p0"><a href="#login" data-fancybox class="btn btn-danger btn-lg popup-login btn-block">BOOK NOW</a></div>
                <?php } else {?>
                <div class="panel-body p0"><a target="_BLANK" href="<?php echo BASE."event_visitor/?event_id=".$post->id."&event_url=".$post->ticket_url?>" class="btn btn-danger btn-lg btn-block">BOOK NOW</a></div>
                <?php }?>
              </div>
              <div class="panel clean widget mb30">
                <div class="panel-body p0">
                  <h4 class="text-black m0">Detail</h4>
                  <table class="table-clean">
                    <colgroup>
                      <col width="30%">
                    </colgroup>
                    <tbody>
                      <tr>
                        <td>Event by</td>
                        <td>: <?php echo $post->event_organizer?></td>
                      </tr>
                      <tr>
                        <td>Ticket</td>
                        <td>: <?php echo $post->ticket_price?></td>
                      </tr>
                      <tr>
                        <td>Date</td>
                        <td>: <?php echo $post->start_date->format("d M Y")?> - <?php echo $post->end_date->format("d M Y")?></td>
                      </tr>
                      <tr>
                        <td>Time</td>
                        <td>: <?php echo $post->event_time?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="panel clean widget mb30">
                <div class="panel-body p0">
                  <h4 class="text-black m0">Contact</h4>
                  <article>
                      <?php echo $post->contact?>
                  </article>
                </div>
              </div>
              <div class="panel clean widget mb30">
                <div class="panel-body p0">
                  <h4 class="text-black m0">Location</h4>
                  <p class="m0"><?php echo $post->location?></p>
                  <div class="embed-responsive embed-responsive-4by3 mt15">
                    <?php echo $post->ticket_maps_widget?>
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix other-events mt60">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="title text-black mt0">Other Events</h4>
          </div>
        </div>
        <div class="row panel-wrap">
        <?php 
        foreach ($related as $key => $value) { 
          if($value->id != $post->id){
        ?>
          <div class="item col-md-3 col-xs-6 p0-xs"><a href="<?php echo BASE.'event/'.$value->category->slug.'/'.$value->slug?>" class="panel block mb0-xs">
              <figure class="panel-body p10"><img src="<?php echo THUMBS.'_369x252/'.$value->featured_image?>" class="mb10">
                <figcaption>
                  <h5 class="text-black title m0"><?php echo Io::excerpt($event->Detail->getTitle($value->id, 1), 60)?></h5>
                  <p class="text-muted m0"><em><?php echo $value->date_publish->format("d M, Y")?></em></p>
                  <p class="text-danger m0">READ MORE</p>
                </figcaption>
              </figure></a></div>
        <?php 
          }
        }
        ?>
        </div>
      </div>
    </section>
  </div>
</main>

<?php include('footer.php');?>