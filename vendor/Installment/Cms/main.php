<?php
$controller = new Installment\Main();
$data = $controller->getAll();

?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Installment Program</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($controller->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=Installment'</script>";
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
						<th>Event Name</th>
		  			<th>Price</th>
		  			<!-- <th>Max Terms</th> -->
		  			<th>Due Date</th>
		  			<th>Date</th>
		  			<th>Status</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
						<td><?php echo $value->name;?></td>
						<td><?php echo number_format($value->price);?></td>
						<!-- <td><?php echo $value->max_term;?> month</td> -->
						<td><?php echo $value->due_date;?></td>
		  			<td><?php echo $value->date_created->format('d M Y H:i:s')?></td>
		  			<td><?php echo $value->is_active==1?'<span class="label label-success">Enabled</span>':'<span class="label label-danger">Disabled</span>'?></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>