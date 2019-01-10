<?php
$data = $ARM->menu->retrieve();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Menu Builder</h3>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=menu&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
			</p>

	  		<table id="" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th>Title</th>
		  			<th>Sort</th>
		  			<th>Status</th>
		  			<th width="20%" colspan="2">Action</th>
	  			</tr>
	  			<?php
				generateMenu(0, $ARM, $dash = 0);

				function generateMenu($parent = 0, $ARM, $dash){
					$conditions['parent'] = $parent;

					$data = $ARM->menu->model->find('all', array( 'conditions' => $conditions, 'order' => 'sort asc'));

					if($data){
						buildMenu($data, $ARM, $dash);
					}
				}

				function buildMenu($data, $ARM, $dash)
				{
					foreach ($data as $k => $v) {
						echo "<tr>";
						echo "<td><span style=margin-right:".($dash*2)."em;></span>" . $ARM->menu->Detail->getTitle($v->id, 1) . "</td>";
						echo "<td><span style=margin-right:".($dash*1)."em;></span>" . $v->sort . "</td>";
						echo "<td>" . ($v->status == 1 ? '<span class="label label-success">Enabled</span>' : '<span class="label label-danger">Disabled</span>') . "</td>";
			  			echo "<td><a href=" . BASE . BACKEND . "/index.php?menu=menu&action=edit&id=" . $v->id . "> <i class='fa fa-pencil-square-o'></i> update</a></td>";
			  			echo "<td><a href=" . BASE . BACKEND . "/index.php?menu=menu&action=delete&id=" . $v->id . "> <i class='fa fa-trash-o'></i> Delete</a></td>";
						echo "</tr>";

						generateMenu($v->id, $ARM, $dash + 1);
					}
				}
				?>
	  			</thead>
  			</table>
		</form>
		</div>
	</div>
</div>
