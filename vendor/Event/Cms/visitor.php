<?php
$event = new Event\Main();
$eventVisitor = new Event\Model\Visitor();
$data = $eventVisitor->find("all", array("order" => "date_created desc", "group" => "user_id"));
?>
<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Event Visitor</h3>
		<form method="post" role="form"> 
	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
		  			<th width="3%">#</th>
						<th>Event</th>
		  			<th>User</th>
		  			<th>Gender</th>
		  			<th>Email</th>
		  			<th>Phone</th>
		  			<th>Date</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($data as $key => $value) { ?>
		  		<tr>
		  			<td><input type="checkbox" name="mass[]" value="<?php echo $value->id?>"></td>
		  			<td><?php echo $event->Detail->getTitle($value->event_id,1);?></td>
		  			<td><?php echo $value->user->name;?></td>
		  			<td><?php echo $value->user->gender;?></td>
		  			<td><?php echo $value->user->email;?></td>
		  			<td><?php echo $value->user->phone;?></td>
		  			<td><?php echo $value->date_created->format("d M Y H:i:s");?></td>
		  		</tr>
				<?php } ?>
  			</table>
		</form>
		</div>
	</div>
</div>