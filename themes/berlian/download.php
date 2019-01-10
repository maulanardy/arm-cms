<?php 
$p           = helper::uri(1); //Slug pertama sebagai parent category
$parent      = $ARM->postsCategory->getBySlug($p); //Get detail parent (category) berdasarkan slug parent
$parentTitle = ucfirst(strtolower($ARM->postsCategory->Detail->getTitle($parent->id)));

// cek apakah parent category memiliki child category
if($ARM->postsCategory->getChildByid($parent->id) == null){
  $slug_1  = $p;
  $slug_2  = helper::uri(2);
  $baseurl_root = BASE;
  $baseurl = BASE;
} else {
  $slug_1       = helper::uri(2);
  $slug_2       = helper::uri(3);

  //
  if($ARM->postsCategory->getBySlug($slug_1) == null){
    $slug_1  = $p;
    $slug_2  = helper::uri(2);
  }

  $baseurl_root = BASE;
  $baseurl      = BASE.$parent->slug.'/';
}

$limit     = 5;
$curr_page = \Io::param("page");

if($curr_page && !empty($curr_page)){
  $offset = $curr_page == 1 ? 0 : $curr_page - 1;
}else{
  $offset    = 0;
  $curr_page = 1;
}

$category = $ARM->postsCategory->getBySlug(empty($slug_1) ? $p : $slug_1); 
$categoryTitle = ucfirst(strtolower($ARM->postsCategory->Detail->getTitle($category->id)));

if(!empty($slug_2)){  
  $post = $ARM->posts->getBySlug($category->id, $slug_2);

  if( !$post ) {
    include 'error404.php';
    exit;
  // }else if($post->youtube_url != ""){
  //   include "post_video.php";
  //   exit;
  }else{
    $ARM->posts->View->addView($post->id);

    include "post_".$post->template.".php";
    exit;
  }
}

$post       = $ARM->posts->getByCategoryId($category->id, $limit, $offset * $limit);
$post_page = ceil($ARM->posts->record / $limit);
$mostRead   = $ARM->posts->getPopular('all', 4);

$header = $categoryTitle;

include('header.php');
?>

<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-event" data-active-page-slug="<?php echo $p?>" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
<!--           <h2 class="h1 text-danger m0">Event</h2> -->
        </div>
        <div class="col-md-4 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
            <?php if(!empty(helper::uri(2))):?><li><a href="<?php echo BASE.$parent->slug?>" class="text-danger"><?php echo strtoupper($parentTitle)?></a></li><?php endif?>
            <li><?php echo strtoupper($categoryTitle)?></li>
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
            <h1 class="page-title text-danger title half-bordered m0"><?php echo $categoryTitle?></h1>
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
                      <div class="media-body media-middle">
                          <h5 class="subtitle m0"><?php echo $value->date_publish->format("d M, Y")?> | <a href="<?php echo $newbaseurl.$value->category->slug?>"><?php echo strtoupper($ARM->postsCategory->Detail->getTitle($value->category->id, 1))?></a></h5>
                          <a href="<?php echo $newbaseurl.$value->category->slug.'/'.$value->slug?>" class="text-black block"><h3 class="title m0"><?php echo $ARM->posts->Detail->getTitle($value->id, 1)?></h3></a>
                          <p class="m0"><?php echo Io::excerpt($ARM->posts->Detail->getExcerpt($value->id, 1),250)?></p></div>
                    </div>
                  </div>
                  <div class="col-sm-3 item"><a href="<?php echo BASE?>download-action?id=<?php echo $value->id?>" class="btn btn-danger mt15">Download</a>
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