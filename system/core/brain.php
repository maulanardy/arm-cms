<?php 

$ARM = new Controller;

$controller = new Ma\Controller\Visitor\Main( new Ma\Model\Visitor\Main() );
$ARM->setter_visitor($controller);

$controller = new Ma\Controller\Admin\Main( new Ma\Model\Admin\Main() );
$ARM->setter_admin($controller);

//$controller = new Ma\Controller\Language\Main( new Ma\Model\Language\Main() );
//$ARM->setter_language($controller);

//$controllerCat = new Ma\Controller\Posts\Category( new Ma\Model\Posts\Category() );
//$controllerCat->setLanguageController( new Ma\Controller\Language\Main( new Ma\Model\Language\Main() ) );
//$controllerCat->setDetailController( new Ma\Controller\Posts\CategoryDetail( new Ma\Model\Posts\CategoryDetail() ) );
//$ARM->setter_post_category($controllerCat);

//$controllerPost = new Ma\Controller\Posts\Main( new Ma\Model\Posts\Main() );
//$controllerPost->setLanguageController( new Ma\Controller\Language\Main( new Ma\Model\Language\Main() ) );
//$controllerPost->setDetailController( new Ma\Controller\Posts\Detail( new Ma\Model\Posts\Detail() ) );
//$controllerPost->setCategoryController($controllerCat);
//$controllerPost->setViewController( new Ma\Controller\Posts\View( new Ma\Model\Posts\View() ) );
//$ARM->setter_post($controllerPost);

//$controllerMediaCategory = new Ma\Controller\Media\Category( new Ma\Model\Media\Category() );
//$ARM->setter_media_category($controllerMediaCategory);

//$controllerMedia = new Ma\Controller\Media\Main( new Ma\Model\Media\Main() );
//$controllerMedia->setCategoryController($controllerMediaCategory);
//$ARM->setter_media($controllerMedia);

//$controller = new Ma\Controller\Menu\Main( new Ma\Model\Menu\Main() );
//$controller->setLanguageController( new Ma\Controller\Language\Main( new Ma\Model\Language\Main() ) );
//$controller->setPostController($controllerPost);
//$controller->setMediaCategoryController($controllerMediaCategory);
//$controller->setDetailController( new Ma\Controller\Menu\Detail( new Ma\Model\Menu\Detail() ) );
//$controller->init();
//$ARM->setter_menu($controller);

$controller = new Ma\Controller\Pages\Main( new Ma\Model\Pages\Main() );
$controller->setLanguageController( new Ma\Controller\Language\Main( new Ma\Model\Language\Main() ) );
$controller->setDetailController( new Ma\Controller\Pages\Detail( new Ma\Model\Pages\Detail() ) );
$ARM->setter_pages($controller);