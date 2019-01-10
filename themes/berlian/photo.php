<?php 
$limit     = 3;
$curr_page = \Io::param("page");

if($curr_page && !empty($curr_page)){
  $offset = $curr_page == 1 ? 0 : $curr_page - 1;
}else{
  $offset    = 0;
  $curr_page = 1;
}

$slug_1  = helper::uri(1);
$slug_2  = helper::uri(2);

if(!empty($slug_1)){
  $category = $ARM->postsCategory->getBySlug($slug_1);
}

if(!empty($slug_2)){  
  $post = $ARM->posts->getBySlug($category->id, $slug_2);

  if( !$post ) {
    include 'error404.php';
    exit;
  }else{
    // $event->View->addView($event->id);

    include "photo_detail.php";
    exit;
  }
}

$photo = $ARM->posts->getLatest('photo',$limit, $offset * $limit);
$post_page = ceil($ARM->posts->record / $limit);

include('header.php');
?>

  <main role="main" class="body">
    <div id="page-info" data-name="p-inner" data-active-page-slug="gallery" data-menu-target="#top-nav"></div>
    <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
          </div>
          <div class="col-md-4 text-right">
            <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
              <li>PHOTO</li>
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
              <h1 class="page-title text-danger title half-bordered m0">Photo Gallery</h1>
            </div>
          </div>
        </div>
      </section>
      <section class="clearfix mt30">
        <div class="container thumbs-gallery">
          <div class="row">
            <?php foreach ($photo as $key => $value) { ?>
            <div class="col-md-4 mb30">
              <figure><a href="<?php echo BASE."photo/".$value->slug?>" rel="thumbs-gallery" title="Everything You Need To Know About Economy" style="background-image: url(<?php echo THUMBS.'_369x252/'.$value->featured_image?>); height: 200px;" class="thumbnail img-cover"></a>
                <figcaption><a href="<?php echo BASE."photo/".$value->slug?>" rel="thumbs-gallery" title="<?php echo $ARM->posts->Detail->getTitle($value->id, 1)?>">
                    <h4 class="text-danger m0"><?php echo $ARM->posts->Detail->getTitle($value->id, 1)?></h4></a>
                    <p class="text-muted m0"><?php echo Io::excerpt($ARM->posts->Detail->getContent($value->id, 1),100)?></p></figcaption>
              </figure>
            </div>
             <?php }?>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <ul class="pagination">
                <?php if($curr_page > 1):?>
                <li><a href="<?php echo BASE.$slug_1.'?page='.($curr_page - 1)?>" class="prevnext">&laquo;</a></li>
                <li><a href="<?php echo BASE.$slug_1.'?page=1'?>" class="prevnext">&lsaquo;</a></li>
                <?php endif ?>

                <?php for($i = 1; $i <= $post_page; $i++): ?>
                <li class="<?php echo $curr_page==$i?'active':''?>">
                  <a href="<?php echo BASE.$slug_1.'?page='.$i?>" title="">
                    <?php echo $i?>
                  </a>
                </li>
                <?php endfor ?>

                <?php if($curr_page < $post_page):?>
                <li><a href="<?php echo BASE.$slug_1.'?page='.($curr_page + 1)?>" class="prevnext">&rsaquo;</a></li>
                <li><a href="<?php echo BASE.$slug_1.'?page='.($post_page)?>" class="prevnext">&raquo;</a></li>
                <?php endif ?>
              </ul>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

<?php include('footer.php');?>