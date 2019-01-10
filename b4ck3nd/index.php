<?php
include("../bootstrap.php");

// ob_end_clean();
if(!$ARM->admin->isLoged()){
    header("Location: ".BASE.BACKEND."/login.php");
    exit;
}

$role = $ARM->admin->detail->category_id;
$admin_detail = $ARM->admin->detail;

$privilege = array(
    "1" => array("", "dashboard", "menu", "Event", "ArtistWishlist", "Installment", "post", "postcategory", "pages", "browser", "media", "media_category", "polling", "GuestBook", "setting", "admin"),
    "2" => array("", "dashboard", "post", "postcategory", "pages", "browser", "media", "media_category", "polling"),
    "5" => array("", "dashboard", "post", "postcategory", "browser", "media", "media_category")
);

if(!in_array(Io::param('menu'), $privilege[$role])){
    header("Location: ".BASE.BACKEND);
    exit;
} 

include("header.php");

?>
    <div id="wrap">
        <div id="top">
            <!-- .navbar -->
            <nav class="navbar navbar-default navbar-static-top">

                <!-- Brand and toggle get grouped for better mobile display -->
                <header class="navbar-header">
                    <a href="<?php echo BASE.BACKEND?>" class="navbar-brand">
                        <img src="assets/img/logo-wide.png" alt="">
                    </a>
                </header>
                <div class="topnav">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <a data-placement="bottom" data-original-title="Show / Hide Sidebar" data-toggle="tooltip" class="btn btn-success btn-sm visible-lg visible-md visible-sm" id="changeSidebarPos">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            <a href="<?php echo BASE.BACKEND?>/logout.php" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-success btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>

                    </div>
                </div><!-- /.topnav -->
            </nav><!-- /.navbar -->

            <!-- header.head -->
            <header class="head">
                <!-- ."main-bar -->
                <div class="main-bar" style="margin-left: 130px;">
                    <h3><i class="fa fa-dashboard"></i> <?php echo Io::param("menu")?ucwords(str_replace("_", " ", Io::param("menu"))):"Dashboard"?></h3>
                </div><!-- /.main-bar -->
            </header>

            <!-- end header.head -->
        </div><!-- /#top -->
        <div id="left" style="width: 130px!important;margin-top: -50px;">
            <div class="media user-media">
                <div class="media-body">
                    <h5 class="media-heading"><?php echo $admin_detail->full_name?></h5>
                    <ul class="list-unstyled user-info">
                        <li> <a href=""><?php echo $admin_detail->category->name?></a> </li>
                        <li>Last Access :
                            <br>
                            <small>
                                <i class="fa fa-calendar"></i>&nbsp;<?php echo $admin_detail->last_login->format("d M H:i")?></small>
                        </li>
                    </ul>
                </div>
            </div>

            <?php include("sidebar.php") ?>

        </div><!-- /#left -->

        <div id="content">
            <div class="outer">
                <div class="inner">

                <?php //require_once(get_page_path(get_page("menu")));?>
                <?php

                $menu = Io::param('menu');
                $sub = Io::param('sub');
                $action = Io::param('action');

                if(!empty($menu) && is_dir('include/'.$menu)){
                    if(empty($action))
                        $action = 'main';
                    require_once('include/'.$menu.'/'.$action.'.php');
                } elseif (!empty($menu) && is_dir('../vendor/'.$menu.'/Cms/')) {
                    if(empty($action)){
                        $action = 'main';
                    }
                    if(!empty($sub)){
                        $action = $sub."-".$action;
                    }
                    require_once('../vendor/'.$menu.'/Cms/'.$action.'.php');
                }else{
                    require_once('dashboard.php');
                }
                ?>

                </div>
                <!-- end .inner -->
            </div>
            <!-- end .outer -->

        </div>
        <!-- end #content -->
    </div><!-- /#wrap -->


<?php include("footer.php") ?>