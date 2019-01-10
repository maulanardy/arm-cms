<?php
$controller = new Installment\Applicant();
$data = $controller->getAll();

?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Installment Application</h3>
  		<?php
			echo helper::flashdata('regStatus'); 

			if(Io::param('delete') && Io::param('mass')){
				if($controller->delete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
					echo "<script>window.location='".BASE.BACKEND."/index.php?menu=Installment&sub=applicant'</script>";
				}
			} 

			if(Io::param('paid') && Io::param('mass')){
				if($controller->paymentComplete(Io::param('mass'))){
					helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
				}
				echo "<script>window.location='".BASE.BACKEND."/index.php?menu=Installment&sub=applicant'</script>";
			} 

		?>
		<form method="post" role="form">
			<p class="clearfix">
				<input type="submit" class="btn btn-sm btn-default pull-right" name="delete" value="Delete Selected">
				<input type="submit" class="btn btn-sm btn-success pull-right" name="paid" value="Payment Complete">
			</p>
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th width="3%">#</th>
						<th>No. Trx</th>
						<th>Ticket Type</th>
						<th>Detail</th>
						<th>Name</th>
						<th>Phone</th>
		  			<th>Amount</th>
		  			<th>Expired Date</th>
		  			<th>Status</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
						<td><?php echo $value->transaction_no;?></td>
						<td><?php echo $value->program->name;?></td>
						<td><?php echo $value->description;?></td>
						<td><?php echo $value->name;?><br>(<?php echo $value->email;?>)</td>
						<td><?php echo $value->phone;?></td>
						<td><?php echo number_format($value->amount + $value->rcode);?></td>
		  			<td><?php echo $value->expire->format('d M Y H:i:s')?></td>
		  			<td><?php echo ($value->is_paid == 1) ? '<span class="label label-success">Paid</span>' : (strtotime($value->expire) < time() ? '<span class="label label-danger">Expired</span>' : '<span class="label label-warning">Waiting</span>')?></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>