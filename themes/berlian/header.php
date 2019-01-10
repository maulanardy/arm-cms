<!DOCTYPE html><!--[if IE 7 ]> <html class="no-js ie ie7 lte7 lte8 lte9" lang="en-US"> <![endif]-->
<!--[if IE 8 ]> <html class="no-js ie ie8 lte8 lte9" lang="en-US"> <![endif]-->
<!--[if IE 9 ]> <html class="no-js ie ie9 lte9>" lang="en-US"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-US" class="no-js"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title><?php echo empty($header) ? "" : $header . " - "?><?php echo Ma\Controller\Setting\Main::get("default_web_title")?></title>
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?php echo !empty($description) ? $description : Ma\Controller\Setting\Main::get("default_web_description")?>">
    <meta name="keywords" content="<?php echo !empty($keywords) ? $keywords : Ma\Controller\Setting\Main::get("default_web_keyword")?>">
    <meta property="og:type" content="article" />
    <meta property="og:description" content="<?php echo !empty($description) ? $description : Ma\Controller\Setting\Main::get("default_web_description")?>" />
    <meta property="og:image" content="<?php echo !empty($ogimg) ? $ogimg : THEMES.'assets/images/repository/header-logo.png'?>" />
    <meta property="og:url" content="<?php echo BASE.$_SERVER[REQUEST_URI]?>" />
    <meta name="google-site-verification" content="">
    <meta name="msvalidate.01" content="">
    <meta name="alexaVerifyID" content="">
    <link rel="shortcut icon" href="<?php echo THEMES?>assets/images/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo THEMES?>assets/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo THEMES?>assets/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo THEMES?>assets/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo THEMES?>assets/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo THEMES?>assets/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo THEMES?>assets/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo THEMES?>assets/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo THEMES?>assets/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo THEMES?>assets/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo THEMES?>assets/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEMES?>assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo THEMES?>assets/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEMES?>assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo THEMES?>assets/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo THEMES?>assets/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i,800|Oswald:300,400" rel="stylesheet">
    <link href="<?php echo THEMES?>assets/styles/style.css" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo THEMES?>assets/styles/dev.css" media="all" rel="stylesheet" type="text/css">
    <script src="<?php echo THEMES?>assets/vendor/modernizr/modernizr.min.js" type="text/javascript"></script><!--[if lt IE 9]>
    <script src="assets/scripts/libs-ie.min.js" type="text/javascript"></script><![endif]-->
    <!--[if lte IE 8]>
    <script language="javascript" type="text/javascript" src="assets/vendor/ExplorerCanvas/excanvas.min.js"></script>
    <![endif]-->
    <!--[if IE]>
    <link href="assets/styles/ie.css" media="all" rel="stylesheet" type="text/css">
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121573326-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-121573326-1');
    </script>
  </head>
  <body data-base="<?php echo BASE?>">
    <div class="allwrap">
      <svg style="height: 0;width: 0;">
        <defs>
          <clipPath id="clip-inner-header" clipPathUnits="objectBoundingBox">
            <polygon fill="none" points="0,0 1,0 1,.9 .9,1 0,.8"></polygon>
          </clipPath>
          <clipPath id="clip-inner-header-mobile" clipPathUnits="objectBoundingBox">
            <polygon fill="none" points="0,0 1,0 1,.95 .9,1 0,.9"></polygon>
          </clipPath>
        </defs>
      </svg>
        <div class="container"><div class="login-section">
          <?php if(!$userController->isLogin()){?>
            <a href="<?php echo BASE?>login">Login</a> / <a href="<?php echo BASE?>register">Register</a>
          <?php } else { ?>
            Welcome <span style="color: #ffc6af;"><?php echo $userController->logedUser()->name?></span>, <a href="<?php echo BASE?>logout">Logout</a>
          <?php } ?>
        </div></div>
      <header class="navbar navbar-fixed-top header header-clean pv15">
        <section class="header-main">
          <div class="container">
            <div class="navbar-header"><a href="<?php echo BASE?>" class="navbar-brand navbar-link"><img src="<?php echo THEMES?>assets/images/repository/header-logo.png" alt=""></a>
              <button type="button" data-target="#top-nav" id="toggle-menu" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse">
              <?php include('menu.php');?>
              <ol data-style="slide-down" id="top-nav" class="nav navbar-nav navbar-right drop-menu mt20 mr0">
              </ol>
            </div>
          </div>
        </section>
      </header>