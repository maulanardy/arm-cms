<?php 
$title = $ARM->posts->Detail->getTitle($post->id, 1);
$related = $ARM->posts->getRelatedByCategory($category->id, explode(",", $post->tags), 4);
$header = $title;
$keywords = $post->tags;
$description = Io::excerpt(strtolower($ARM->posts->Detail->getContent($post->id, 1)),150);
$ogimg = UPLOAD.$post->featured_image;
$gallery = $ARM->media->findByCategory($post->gallery_id);

include('header.php');
?>

  <main role="main" class="body">
    <div id="page-info" data-name="p-inner" data-active-page-slug="gallery" data-menu-target="#top-nav"></div>
    <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
                <h2 class="h1 text-danger m0">Photo Gallery</h2>
          </div>
          <div class="col-md-8 text-right">
            <ol class="breadcrumb m0 p0">
              <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
              <li><a href="<?php echo BASE?>video" class="text-danger">PHOTO</a></li>
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
          <?php 
          foreach ($gallery as $key => $value) { 
          ?>
            <div class="col-md-4 mb30">
              <figure><a href="<?php echo UPLOAD.$value->file?>" rel="thumbs-gallery" title="" style="background-image: url(<?php echo THUMBS.'_369x252/'.$value->file?>); height: 200px;" class="popup-gallery thumbnail img-cover"></a>
                <figcaption>
                  <h4 class="text-danger m0"><?php echo $value->title?></h4>
                  <p class="text-muted m0"><?php echo $value->content?></p>
                </figcaption>
              </figure>
            </div>
          <?php 
          }
          ?>
          </div>
        </div>
      </section>
      <section class="clearfix mt60">
        <div class="container thumbs-gallery">
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-danger mt0 mb30">RELATED PHOTO GALLERY</h3>
            </div>
          </div>
          <div class="row">
          <?php 
          foreach ($related as $key => $value) { 
            if($value->id != $post->id){
          ?>
            <div class="col-md-4 mb30">
              <figure><a href="<?php echo BASE."photo/".$value->slug?>" rel="thumbs-gallery" title="<?php echo $ARM->posts->Detail->getTitle($value->id, 1)?>" style="background-image: url(<?php echo THUMBS.'_369x252/'.$value->featured_image?>); height: 200px;" class="thumbnail img-cover"></a>
                <figcaption><a href="<?php echo BASE."photo/".$value->slug?>" rel="thumbs-gallery" title="<?php echo $ARM->posts->Detail->getTitle($value->id, 1)?>">
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