<?php
$data = $ARM->mediaCategory->retrieve();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Gallery Name</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($ARM->mediaCategory->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=media_category'</script>";
				}
			} 
		?>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=media_category&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th>Title</th>
		  			<th>Description</th>
		  			<th>Status</th>
		  			<th width="50%" colspan="3">Action</th>
	  			</tr>
	  			</thead>

				<?php
				generateMenu(0, $ARM, $dash = 0);

				function generateMenu($parent = 0, $ARM, $dash){
					$conditions['parent'] = $parent;

					$data = $ARM->mediaCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

					if($data){
						buildMenu($data, $ARM, $dash);
					}
				}

				function buildMenu($data, $ARM, $dash)
				{
					foreach ($data as $k => $v) {
						echo "<tr>";
						echo "<td><span style=margin-right:".($dash*2)."em;></span>" . $v->title . "</td>";
						echo "<td>" . $v->description . "</td>";
						echo "<td>" . ($v->status == 1 ? '<span class="label label-success">Enabled</span>' : '<span class="label label-danger">Disabled</span>') . "</td>";
		  			echo "<td><a href=" . BASE . BACKEND . "/index.php?menu=media&cat=" . $v->slug . "> <i class='fa fa-picture-o'></i> view photo</a></td>";
		  			echo "<td><a href=" . BASE . BACKEND . "/index.php?menu=media_category&action=edit&id=" . $v->id . "> <i class='fa fa-pencil-square-o'></i> update</a></td>";
		  			echo "<td><a href=" . BASE . BACKEND . "/index.php?menu=media_category&action=delete&id=" . $v->id . "> <i class='fa fa-trash-o'></i> Delete</a></td>";
						echo "</tr>";

						generateMenu($v->id, $ARM, $dash + 1);
					}
				}
				?>
			</table>
		</form>
		</div>
	</div>
</div>