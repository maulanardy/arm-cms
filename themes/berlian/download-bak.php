<?php 
$limit     = 5;
$curr_page = \Io::param("page");

if($curr_page && !empty($curr_page)){
  $offset = $curr_page == 1 ? 0 : $curr_page - 1;
}else{
  $offset    = 0;
  $curr_page = 1;
}

$category = $ARM->postsCategory->getBySlug("news"); 
$categoryTitle = ucfirst(strtolower($ARM->postsCategory->Detail->getTitle($category->id)));

$post       = $ARM->posts->getByCategoryId($category->id, $limit, $offset * $limit);
$post_page = ceil($ARM->posts->record / $limit);

$header = $categoryTitle;

include('header.php');
?>

<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-event" data-active-page-slug="download" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
<!--           <h2 class="h1 text-danger m0">Event</h2> -->
        </div>
        <div class="col-md-4 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
            <li>DOWNLOAD</li>
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
            <h1 class="page-title text-danger title half-bordered m0">DOWNLOAD</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix data-lists">
      <svg style="height: 0;width: 0;">
        <defs>
          <clipPath id="clip-square" clipPathUnits="objectBoundingBox">
            <polygon fill="none" points=".5,0 1,.5 .5,1 0,.5"></polygon>
          </clipPath>
        </defs>
      </svg>
      <div class="container">
        <div class="row">
          <?php 
          foreach ($post as $key => $value): 
            $newbaseurl = $value->category->slug == $parent->slug ? $baseurl_root : $baseurl;
          ?>
          
            <div class="col-sm-12 ph0-xs">
              <div class="well">
                <div class="row matchHeight">
                  <div class="col-sm-9 item">
                    <div class="media">
                      <div class="media-left"><a href="<?php echo $newbaseurl.$value->category->slug.'/'.$value->slug?>" class="block"><img src="<?php echo THUMBS.'_219x219/'.$value->featured_image?>" alt="<?php echo $ARM->posts->Detail->getTitle($value->id, 1)?>"></a></div>
                      <div class="media-body media-middle">
                          <h5 class="subtitle m0"><?php echo $value->date_publish->format("d M, Y")?> | <a href="<?php echo $newbaseurl.$value->category->slug?>"><?php echo strtoupper($ARM->postsCategory->Detail->getTitle($value->category->id, 1))?></a></h5>
                          <a href="<?php echo $newbaseurl.$value->category->slug.'/'.$value->slug?>" class="text-black block"><h3 class="title m0"><?php echo $ARM->posts->Detail->getTitle($value->id, 1)?></h3></a>
                          <p class="m0"><?php echo Io::excerpt($ARM->posts->Detail->getExcerpt($value->id, 1),250)?></p></div>
                    </div>
                  </div>
                  <div class="col-sm-3 item"><a href="<?php echo $newbaseurl.$value->category->slug.'/'.$value->slug?>" class="btn btn-danger btn-book-sm mt15">READ MORE</a>
                    <div class="btn-book-r">
                      <div class="valign-middle by-table"><a href="<?php echo $newbaseurl.$value->category->slug.'/'.$value->slug?>" class="btn btn-danger btn-book"><span class="valign-middle by-table">READ<br>MORE</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          <?php endforeach ?>
        </div>
        <div class="row mt30">
          <div class="col-md-12 text-center">

            <ul class="pagination">
              <?php if($curr_page > 1):?>
              <li><a href="<?php echo $baseurl.$slug_1.'?page='.($curr_page - 1)?>" class="prevnext">&laquo;</a></li>
              <li><a href="<?php echo $baseurl.$slug_1.'?page=1'?>" class="prevnext">&lsaquo;</a></li>
              <?php endif ?>

              <?php for($i = 1; $i <= $post_page; $i++): ?>
              <li class="<?php echo $curr_page==$i?'active':''?>">
                <a href="<?php echo $baseurl.$slug_1.'?page='.$i?>" title="">
                  <?php echo $i?>
                </a>
              </li>
              <?php endfor ?>

              <?php if($curr_page < $post_page):?>
              <li><a href="<?php echo $baseurl.$slug_1.'?page='.($curr_page + 1)?>" class="prevnext">&rsaquo;</a></li>
              <li><a href="<?php echo $baseurl.$slug_1.'?page='.($post_page)?>" class="prevnext">&raquo;</a></li>
              <?php endif ?>
            </ul>

          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<?php include('footer.php');?>