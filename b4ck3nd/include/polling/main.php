<?php
$polling = new \Polling\Main();

$data = $polling->getAll();
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Polling</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($polling->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=polling'</script>";
				}
			} 
		?>
		<form method="post" role="form">
			<p class="clearfix">
				<a href="<?php echo BASE.BACKEND?>/index.php?menu=polling&action=create" class="btn btn-sm btn-default pull-left"> Add New </a>
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th width="3%">#</th>
		  			<th>Judul</th>
		  			<th>Pertanyaan</th>
		  			<th>Status</th>
		  			<th>Created</th>
		  			<th>Publish</th>
		  			<th width="5%">Action</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
		  			<td><?php echo $value->title;?></td>
		  			<td><?php echo $value->question;?></td>
		  			<td><?php echo $value->is_active==1?'<span class="label label-success">Enabled</span>':'<span class="label label-danger">Disabled</span>'?><?php echo $value->is_featured==1?'<br><span class="label label-primary">Featured</span>':''?></td>
		  			<td><?php echo $value->date_created->format('d M Y')?></td>
		  			<td><?php echo $value->date_publish->format('d M Y')?></td>
		  			<td><a href="<?php echo BASE.BACKEND?>/index.php?menu=polling&action=view&id=<?php echo $value->id?>"> <i class="fa fa-search"></i> detail</a><br><a href="<?php echo BASE.BACKEND?>/index.php?menu=polling&action=edit&id=<?php echo $value->id?>"> <i class="fa fa-pencil-square-o"></i> update</a></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>