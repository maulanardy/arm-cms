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
  <div id="page-info" data-name="p-inner" data-active-page-slug="our-business" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <!-- <h2 class="h1 text-danger m0">Our Business</h2> -->
        </div>
        <div class="col-md-4 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="index.html" class="text-danger">HOME</a></li>
            <li><?php echo strtoupper($ARM->pages->Detail->getTitle($pages->id, 1))?></li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <div class="clearfix content pt60 mt60 pt0-sm">
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="page-title text-danger title half-bordered m0"><?php echo $ARM->pages->Detail->getTitle($pages->id, 1)?></h1>
          </div>
        </div>
      </div>
    </section>
    <?php echo $ARM->pages->Detail->getContent($pages->id)?>
  </div>
</main>

<?php include('footer.php');?>