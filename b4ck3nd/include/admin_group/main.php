<?php
$data = $ARM->admin->retrieve();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Admin Group</h3>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=post&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th>#</th>
		  			<th>Role</th>
		  			<th>Status</th>
		  			<!-- <th>Action</th> -->
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td></td>
		  			<td><?php echo $value->name?></td>
		  			<td><?php echo $value->status==1?'<span class="label label-success">Active</span>':'<span class="label label-danger">Inactive</span>'?></td>
		  			<!-- <td><a href="<?php echo BASE.BACKEND?>/index.php?menu=post&action=edit&id=<?php echo $value->id?>"> <i class="fa fa-pencil-square-o"></i> update</a></td> -->
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>