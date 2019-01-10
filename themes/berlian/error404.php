<?php 
$header = "ERROR 404";

include('header.php'); 
?> 

<main role="main" class="body">
  <div id="page-info" data-name="p-inner p-about" data-active-page-slug="<?php echo $slug?>" data-menu-target="#top-nav"></div>
  <section style="background-image: url(<?php echo THEMES?>assets/images/repository/inner-header-bg.jpg)" class="clearfix inner-header img-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4 text-right">
          <ol class="breadcrumb m0 p0">
            <li><a href="<?php echo BASE?>" class="text-danger">HOME</a></li>
            <li>Error 404</li>
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
            <h1 class="page-title text-danger title half-bordered m0">Error 404</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="clearfix">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <article>
              Page not found, back to <a href="<?php echo BASE?>">Homepage</a>
            </article>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<?php include 'footer.php';?>