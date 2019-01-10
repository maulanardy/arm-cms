<?php 
$slug = helper::uri(1);
$pages = $ARM->pages->findBySlug($slug);

if( !$pages ) {

  include 'error404.php';
  exit;

}

$header = ucfirst(strtolower($ARM->pages->Detail->getTitle($pages->id, 1)));
$description = strtolower($ARM->pages->Detail->getExcerpt($pages->id, 1));

$mostRead = $ARM->posts->getPopular('all', 4);

$hashtagC = new \Ma\Controller\Posts\Hashtag();
$hashtag = $hashtagC->getPopular(10);

include('header.php'); 

?>

<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-about" data-active-page-slug="<?php echo $slug?>" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
<!--           <h2 class="h1 text-danger m0"><?php echo $ARM->pages->Detail->getTitle($pages->id, 1)?></h2> -->
        </div>
        <div class="col-md-4 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
            <li><?php echo strtoupper($ARM->pages->Detail->getTitle($pages->id, 1))?></li>
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
            <h1 class="page-title text-danger title half-bordered m0"><?php echo $ARM->pages->Detail->getTitle($pages->id, 1)?></h1>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <?php if(!empty($pages->featured_image)):?>
            <div class="col-sm-4"><img src="<?php echo UPLOAD.$pages->featured_image?>" alt=""></div>
          <?php endif;?>
          <div class="<?php echo empty($pages->featured_image) ? "col-sm-12" : "col-sm-8"?>">
            <article>
              <?php echo $ARM->pages->Detail->getContent($pages->id)?>
            </article>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<?php include('footer.php');?>