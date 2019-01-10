<?php
$data = $ARM->posts->retrieve();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Posts</h3>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=post&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th>#</th>
		  			<th>Category</th>
		  			<th>Title</th>
		  			<th>Status</th>
		  			<th>Date Created</th>
		  			<th>Date Published</th>
		  			<th>Action</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td></td>
		  			<td><?php echo $value->category->cat_name?></td>
		  			<td><?php echo $value->post_title?></td>
		  			<td><?php echo $value->post_status==1?'Enabled':'Disabled'?></td>
		  			<td><?php echo $value->post_input_date->format('d M Y')?></td>
		  			<td><?php echo $value->post_publish_up->format('d M Y')?></td>
		  			<td><a href="<?php echo BASE.BACKEND?>/index.php?menu=post&action=edit&id=<?php echo $value->id?>"> <i class="fa fa-pencil-square-o"></i> update</a></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>