<?php

if(!isset($_GET["cat"])){
	header("Location: index.php?menu=media_category");
}

$category = $_GET["cat"];

$dataCat = $ARM->mediaCategory->getBySlug($category);
$data = $ARM->media->findAllByCategoryId($dataCat->id);
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Gallery <i>"<?php echo $dataCat->title?>"</i></h3>
		<?php 
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($ARM->media->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=media'</script>";
				}
			} 
		?>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=media_category" class="btn btn-sm btn-danger"> << Back</a>
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=media&cat=<?php echo $category?>&action=pick" class="btn btn-sm btn-primary"> Add New Item</a>
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th width="3%">#</th>
		  			<th>Item</th>
		  			<th>Date Created</th>
		  			<th>Status</th>
		  			<th width="5%">Action</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
		  			<td>
		  			<img src="<?php echo THUMBS."_100x100/".$value->file?>"><br>
		  			Title : "<?php echo $value->title?>"	  				
		  			</td>
		  			<td><?php echo helper::datetime_parse($value->date_created, 'd M Y')?></td>
		  			<td><?php echo $value->status==1?'<span class="label label-success">Enabled</span>':'<span class="label label-danger">Disabled</span>'?></td>
		  			<td><a href="<?php echo BASE.BACKEND?>/index.php?menu=media&action=edit&id=<?php echo $value->id?>"> <i class="fa fa-pencil-square-o"></i> update</a></td>
		  		</tr>
				<?php } ?>
			</table>
		</form>
		</div>
	</div>
</div>