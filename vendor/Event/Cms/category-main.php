<?php
$category = new Event\Category();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Event Category</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($category->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=Event&sub=category'</script>";
				}
			} 
		?>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=Event&sub=category&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
			</p>
	  		<table id="" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th>Title</th>
		  			<th>Description</th>
		  			<th>Status</th>
		  			<th width="20%" colspan="2">Action</th>
	  			</tr>
	  			</thead>
				<?php
				generateMenu(0, $category, $dash = 0);

				function generateMenu($parent = 0, $controller, $dash){
					$conditions['parent'] = $parent;

					$data = $controller->model->find('all', array( 'conditions' => $conditions, 'order' => 'id asc'));

					if($data){
						buildMenu($data, $controller, $dash);
					}
				}

				function buildMenu($data, $controller, $dash)
				{
					foreach ($data as $k => $v) {
						echo "<tr>";
						echo "<td><span style=margin-right:".($dash*2)."em;></span>" . $controller->Detail->getTitle($v->id, 1) . "</td>";
						echo "<td>" . $controller->Detail->getDescription($v->id, 1) . "</td>";
						echo "<td>" . ($v->status == 1 ? '<span class="label label-success">Enabled</span>' : '<span class="label label-danger">Disabled</span>') . "</td>";
			  			echo "<td><a href=" . BASE . BACKEND . "/index.php?menu=Event&sub=category&action=edit&id=" . $v->id . "> <i class='fa fa-pencil-square-o'></i> update</a></td>";
			  			echo "<td><a href=" . BASE . BACKEND . "/index.php?menu=Event&sub=category&action=delete&id=" . $v->id . "> <i class='fa fa-trash-o'></i> Delete</a></td>";
						echo "</tr>";

						generateMenu($v->id, $controller, $dash + 1);
					}
				}
				?>
  			</table>
		</form>
		</div>
	</div>
</div>