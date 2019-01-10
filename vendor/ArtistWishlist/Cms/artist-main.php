<?php
$controller = new ArtistWishlist\Main();
$data = $controller->getAll();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Artist List</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($controller->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=ArtistWishlist&sub=artist'</script>";
				}
			} 
		?>
		<form method="post" role="form">
			<p class="clearfix">
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th width="3%">#</th>
		  			<th>Name</th>
		  			<th>Status</th>
		  			<th>Date</th>
		  			<th width="20%" colspan="2">Action</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
		  			<td><?php echo $value->name;?></td>
		  			<td><?php echo $value->status==1?'<span class="label label-success">Enabled</span>':'<span class="label label-danger">Disabled</span>'?></td>
		  			<td><?php echo $value->created_date->format('d M Y H:i:s')?></td>
		  			<td><a href="<?php echo BASE.BACKEND?>/index.php?menu=ArtistWishlist&sub=artist&action=edit&id=<?php echo $value->id?>"> <i class="fa fa-pencil-square-o"></i> update</a></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>