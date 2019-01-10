<?php
$gb = new GuestBook\Main();
$data = $gb->getAll();

?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Guest Book</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($gb->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=Event'</script>";
				}
			} 

		?>
		<form method="post" role="form">
			<p class="clearfix">
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th width="3%">#</th>
		  			<th>Name</th>
		  			<th>Email</th>
		  			<th>Subject</th>
		  			<th>Message</th>
		  			<th>Date</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
		  			<td><?php echo $value->name;?></td>
		  			<td><?php echo $value->email;?></td>
		  			<td><?php echo $value->subject;?></td>
		  			<td><?php echo $value->messages;?></td>
		  			<td><?php echo $value->created_date->format('d M Y')?></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>