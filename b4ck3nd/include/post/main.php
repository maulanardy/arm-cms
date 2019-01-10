<?php
$data = $ARM->posts->retrieve();

?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Posts</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($ARM->posts->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=post'</script>";
				}
			} 

		?>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=post&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th width="3%">#</th>
					<th>Category</th>
		  			<th>Title</th>
		  			<th>Template</th>
		  			<th>Status</th>
		  			<th>Featured</th>
		  			<th>Menu Highlight</th>
		  			<th>Date Published</th>
		  			<th width="5%">Action</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
					<td><?php echo $ARM->postsCategory->Detail->getTitle($value->category_id, 1);?>
						<?php
						foreach($value->position_relation as $i => $j){
							echo '<br><div class="label label-warning">'.$j->position->title."</div>";
						}
						?>
					</td>
		  			<td><?php echo $ARM->posts->Detail->getTitle($value->id, 1);?></td>
		  			<td><?php echo $value->template;?></td>
		  			<td><?php echo $value->status==1?'<span class="label label-success">Enabled</span>':'<span class="label label-danger">Disabled</span>'?></td>
		  			<td><?php echo $value->featured==1?'<span class="label label-primary">Featured</span>':''?></td>
		  			<td><?php echo $value->highlight==1?'<span class="label label-warning">Highlighted</span>':''?></td>
		  			<td><?php echo $value->date_publish->format('d M Y')?></td>
		  			<td><a href="<?php echo BASE.BACKEND?>/index.php?menu=post&action=edit&id=<?php echo $value->id?>"> <i class="fa fa-pencil-square-o"></i> update</a></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>