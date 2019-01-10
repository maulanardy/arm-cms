<?php
use Ma\Controller\Admin;
use Ma\Controller\Visitor;
use Ma\Controller\Language;
use Ma\Controller\Menu;
use Ma\Controller\Posts;
use Ma\Controller\Pages;
use Ma\Controller\Media;

use Ma\Model\Admin as MAdmin;
use Ma\Model\Visitor as MVisitor;
use Ma\Model\Language as MLanguage;
use Ma\Model\Menu as MMenu;
use Ma\Model\Posts as MPosts;
use Ma\Model\Pages as MPages;
use Ma\Model\Media as MMedia;

class Controller
{
	public $language;
	public $visitor;
	public $admin;
	public $member;
	public $menu;
	public $posts;
	public $pages;
	public $postsCategory;
	public $media;
	public $mediaCategory;

	public function __construct(){
		$this->language = new Language\Main( new MLanguage\Main() );
		$this->postsCategory = new Posts\Category( new MPosts\Category() );
		$this->posts = new Posts\Main( new MPosts\Main() );
		$this->mediaCategory = new Media\Category( new MMedia\Category() );
		$this->media = new Media\Main( new MMedia\Main() );
		$this->menu = new Menu\Main( new MMenu\Main() );

		$this->setter_post_category();
		$this->setter_post();
		$this->setter_menu();
		$this->setter_media();
	}

	public function setter_language(Language\Main $lang)
	{
		$this->language = $lang;
	}

	public function setter_visitor(Visitor\Main $visitor)
	{
		$this->visitor = $visitor;
	}

	public function setter_admin(Admin\Main $admin)
	{
		$this->admin = $admin;
	}

	public function setter_menu()
	{
		$this->menu->setLanguageController( new Ma\Controller\Language\Main( new Ma\Model\Language\Main() ) );
		$this->menu->setPostController($this->posts);
		$this->menu->setMediaCategoryController($this->mediaCategory);
		$this->menu->setDetailController( new Ma\Controller\Menu\Detail( new Ma\Model\Menu\Detail() ) );
		$this->menu->init();
	}
	public function setter_post()
	{
		$this->posts->setLanguageController( new Language\Main( new MLanguage\Main() ) );
		$this->posts->setCategoryController($this->postsCategory);
		$this->posts->setViewController( new Posts\View( new MPosts\View() ) );
	}
	public function setter_pages(Pages\Main $pages)
	{
		$this->pages = $pages;
	}

	public function setter_post_category()
	{
		$this->postsCategory->setLanguageController( new Language\Main( new MLanguage\Main() ) );
		$this->postsCategory->setDetailController( new Posts\CategoryDetail( new MPosts\CategoryDetail() ) );
	}

	public function setter_media()
	{
		$this->media->setCategoryController($this->mediaCategory);
	}
}