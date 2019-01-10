<?php 
$c[\Io::param('menu')] = 'active';

	$menu['dashboard']['icon'] = 'fa-tachometer';
	$menu['dashboard']['name'] = 'Dashboard';

if($role == 1){
	$menu['menu']['icon'] = 'fa-list';
	$menu['menu']['name'] = 'Menu';
}

if($role == 1 || $role == 2 || $role == 5){

	$menu['post']['icon']                  = 'fa-pencil';
	$menu['post']['name']                  = 'Post';
	$menu['post']['child']['post']         = 'All Posts';
	$menu['post']['child']['postcategory'] = 'Categories';
}

if($role == 1){

	$menu['Event']['icon']                  = 'fa-calendar';
	$menu['Event']['name']                  = 'Event';
	$menu['Event']['child']['Event']         = 'All Event';
	$menu['Event']['child']['Event&sub=category'] = 'Categories';
	$menu['Event']['child']['Event&action=visitor'] = 'Visitor';
}

if($role == 1 || $role == 2){
	$menu['pages']['icon'] = 'fa-files-o';
	$menu['pages']['name'] = 'Pages';
}

if($role == 1 || $role == 2 || $role == 5){
	$menu['media']['icon']                    = 'fa-camera';
	$menu['media']['name']                    = 'Media';
	$menu['media']['child']['browser']        = 'Browser';
	$menu['media']['child']['media_category'] = 'Gallery';
}

if($role == 1){

	$menu['GuestBook']['icon']                  = 'fa-envelope-o';
	$menu['GuestBook']['name']                  = 'Guest Book';
}

if($role == 1){
	$menu['divider1'] = "divider";

	$menu['setting']['icon'] = 'fa-gear';
	$menu['setting']['name'] = 'Global Setting';

	$menu['admin']['icon']                    = 'fa-key';
	$menu['admin']['name']                    = 'Admin';
	$menu['admin']['child']['admin']          = 'Daftar Admin';
}

?>


<!-- #menu -->
<ul id="menu" class="collapse">
	<li class="nav-header">Menu</li>
	<li class="nav-divider"></li>

	<?php foreach ($menu as $key => $value): ?>

		<?php if(!empty($value['child'])){?>

			<li class="<?php echo array_key_exists(Io::param('menu'),$value['child'])?'active':''?>">
				<a href="javascript:;">
					<i class="fa <?php echo $value['icon']?>"></i>
					<span class="link-title"><?php echo $value['name']?></span>
					<span class="fa arrow"></span>
				</a>
				<ul>
					<?php foreach ($value['child'] as $x => $y){ ?>
						<li class="<?php echo $c[$x]?>">
							<a href="<?php echo BASE.BACKEND?>/index.php?menu=<?php echo $x?>">
								<i class="fa fa-angle-right"></i>&nbsp;<?php echo $y?>
							</a>
						</li>
					<?php }?>
				</ul>
			</li>

		<?php }else if($value == "divider"){?>

			<li class="nav-divider">sdf</li>

		<?php }else{?>

			<li class="<?php echo $c[$key]?>">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=<?php echo $key?>">
					<i class="fa <?php echo $value['icon']?>"></i>&nbsp; <?php echo $value['name']?></a>
			</li>

		<?php }?>

	<?php endforeach ?>

</ul><!-- /#menu -->