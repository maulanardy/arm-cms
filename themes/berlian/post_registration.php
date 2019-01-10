<?php
$eventController = new Event\Main();
$related = $ARM->posts->getRelated(explode(",", $post->tags), 4);
$title = $ARM->posts->Detail->getTitle($post->id, 1);
$header = $title;
$keywords = $post->tags;
$description = strtolower($ARM->posts->Detail->getExcerpt($post->id, 1));
$ogimg = UPLOAD.$post->featured_image;
$categoryTitle = ucfirst(strtolower($ARM->postsCategory->Detail->getTitle($category->id)));
$newbaseurl = $post->category->slug == $parent->slug ? $baseurl_root : $baseurl;


include('header.php'); 
?>

<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-event" data-active-page-slug="<?php echo $parent->slug?>" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2 class="h1 text-danger m0"><?php echo $categoryTitle?></h2>
        </div>
        <div class="col-md-8 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
            <?php if(!empty(helper::uri(3))):?><li><a href="<?php echo BASE.$parent->slug?>" class="text-danger"><?php echo strtoupper($parentTitle)?></a></li><?php endif?>
            <li><a href="<?php echo $newbaseurl.$category->slug?>" class="text-danger"><?php echo strtoupper($categoryTitle)?></a></li>
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
            <article class="mb30"><img src="<?php echo UPLOAD.$post->featured_image?>" alt="<?php echo $title?>" class="mb30">
                <?php echo $ARM->posts->Detail->getContent($post->id, 1)?>
            </article>
            <div class="panel-body p0"><a href="<?php echo BASE?>apply/?post_id=<?php echo $post->id?>" class="btn btn-danger btn-lg btn-block">APPLY NOW</a></div>
          </div>
          <div class="col-sm-4 mb30">
            <aside>
              <div class="panel clean widget mb30">
                <div class="panel-body p0"><a href="<?php echo BASE?>apply?post_id=<?php echo $post->id?>" class="btn btn-danger btn-lg btn-block">APPLY NOW</a></div>
              </div>
            </aside>
            <aside class="post">
              <div class="panel clean widget mb30">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4 class="title text-black mt0">Upcoming Events</h4>
                    </div>
                  </div>
                  <div class="row panel-wrap">
                    <div class="item col-md-12 col-xs-12 p0-xs">
                      <?php foreach ($eventController->getNextEvent(3) as $key => $value) { ?>

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
    <section class="clearfix other-events mt60">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="title text-black mt0">Related Posts</h4>
          </div>
        </div>
        <div class="row panel-wrap">
        <?php 
        foreach ($related as $key => $value) { 
        	if($value->id != $post->id){
            $newbaseurl = $value->category->slug == $parent->slug ? $baseurl_root : $baseurl;
        ?>
          <div class="item col-md-3 col-xs-6 p0-xs"><a href="<?php echo $newbaseurl.$value->category->slug.'/'.$value->slug?>" class="panel block mb0-xs">
              <figure class="panel-body p10"><img src="<?php echo THUMBS.'_369x252/'.$value->featured_image?>" class="mb10">
                <figcaption>
                  <h5 class="text-black title m0"><?php echo Io::excerpt($ARM->posts->Detail->getTitle($value->id, 1), 60)?></h5>
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