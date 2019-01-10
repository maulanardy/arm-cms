<?php 
$title = $ARM->posts->Detail->getTitle($post->id, 1);
$related = $ARM->posts->getRelatedByCategory($category->id, explode(",", $post->tags), 4);
$header = $title;
$keywords = $post->tags;
$description = Io::excerpt(strtolower($ARM->posts->Detail->getContent($post->id, 1)),150);
$ogimg = UPLOAD.$post->featured_image;

include('header.php');
?>

  <main role="main" class="body">
    <div id="page-info" data-name="p-inner" data-active-page-slug="gallery" data-menu-target="#top-nav"></div>
    <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
                <h2 class="h1 text-danger m0">Video Gallery</h2>
          </div>
          <div class="col-md-8 text-right">
            <ol class="breadcrumb m0 p0">
              <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
              <li><a href="<?php echo BASE?>video" class="text-danger">VIDEO</a></li>
              <li><?php echo Io::excerpt($title, 50)?></li>
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
              <h1 class="page-title text-danger title half-bordered m0"><?php echo $title?></h1>
            </div>
          </div>
        </div>
      </section>
      <section class="clearfix vid-gallery">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.youtube.com/embed/<?php echo $post->youtube?>" frameborder="0" allowfullscreen="" style="max-height: 500px;" class="embed-responsive-item"></iframe>
              </div>
            </div>
          </div>
          <div class="row mt15">
            <div class="col-md-12">
              <p class="m0"><?php echo $ARM->posts->Detail->getContent($post->id, 1)?></p>
            </div>
          </div>
        </div>
      </section>
      <section class="clearfix mt60">
        <div class="container thumbs-gallery">
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-danger mt0 mb30">RELATED VIDEO</h3>
            </div>
          </div>
          <div class="row">
          <?php 
          foreach ($related as $key => $value) { 
            if($value->id != $post->id){
          ?>
            <div class="col-md-4 mb30">
              <figure><a href="<?php echo BASE."video/".$value->slug?>" rel="thumbs-gallery" title="<?php echo $ARM->posts->Detail->getTitle($value->id, 1)?>" style="background-image: url(https://img.youtube.com/vi/<?php echo $value->youtube?>/hqdefault.jpg); height: 200px;" class="thumbnail img-cover">
                  <div class="valign-middle by-transform"><i class="block fa fa-play-circle"></i></div></a>
                <figcaption><a href="<?php echo BASE."video/".$value->slug?>" rel="thumbs-gallery" title="<?php echo $ARM->posts->Detail->getTitle($value->id, 1)?>">
                    <h4 class="text-danger m0"><?php echo $ARM->posts->Detail->getTitle($value->id, 1)?></h4>
                    <p class="text-muted m0"><?php echo Io::excerpt($ARM->posts->Detail->getContent($value->id, 1),100)?></p></a></figcaption>
              </figure>
            </div>
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