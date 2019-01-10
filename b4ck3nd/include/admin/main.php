<?php
$data = $ARM->admin->retrieve();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Admin</h3>

		<?php 
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($ARM->admin->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=admin'</script>";
				}
			} 
		?>

		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=admin&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th>#</th>
		  			<th>Username</th>
		  			<th>Initial</th>
		  			<th>Role</th>
		  			<th>Full Name</th>
		  			<th>Email</th>
		  			<th>Status</th>
		  			<th>Last Login</th>
		  			<th>Action</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
		  			<td><?php echo $value->name?></td>
		  			<td><?php echo $value->initial?></td>
		  			<td><?php echo $value->category->name?></td>
		  			<td><?php echo $value->full_name?></td>
		  			<td><?php echo $value->email?></td>
		  			<td><?php echo $value->status==1?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>'?></td>
		  			<td><?php echo $value->last_login ? $value->last_login->format('h:i:s d M Y') : "-"?></td>
		  			<td><a href="<?php echo BASE.BACKEND?>/index.php?menu=admin&action=edit&id=<?php echo $value->id?>"> <i class="fa fa-pencil-square-o"></i> update</a></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>