<?php
$polling = new \Polling\Main();
$pollingAnswer = new \Polling\Answer();

$data = $polling->getById(Io::param("id"));
$answer = $pollingAnswer->getByPollingId($data->id);
?>


<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <header>
        <h5>Polling "<?php echo $data->title?>"</h5>
        <div class="toolbar">
          <a href="<?php echo BASE.BACKEND?>/index.php?menu=polling" class="btn btn-sm btn-danger pull-right"> Back </a>
        </div><!-- /.toolbar -->
      </header>
      <div class="body">
			<h3><?php echo $data->question?></h3>

      <?php 
        $totalvote = 0;
        foreach ($data->option as $k => $v) { $totalvote += count($v->answer); }
        foreach ($data->option as $k => $v) { 
          $vote = round(count($v->answer) * 100 / $totalvote);?>

          <h6><?php echo $v->value?></h6>

	        <div class="progress progress-striped active" style="background: #c5d4e0;">
	          <span class="" style="color: #FFFFFF;position: absolute;margin-left: 10px;"><?php echo count($v->answer)?> Suara</span>
	          <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo count($v->answer) . "-" . $totalvote?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $vote?>%;">
	          </div>
	        </div><!-- /.progress -->

        <?php } ?>

	  		<table id="datatables" class="table table-bordered tablesorter">
	  			<thead>
	  			<tr>
	  				<th>#</th>
		  			<th>IP Address</th>
		  			<th>Pilihan</th>
		  			<th>Created</th>
	  			</tr>
	  			</thead>
		  		<?php foreach ($answer as $key => $value) { ?>
		  		<tr>
		  			<td><?php echo $key + 1;?></td>
		  			<td><?php echo $value->ip_address;?></td>
		  			<td><?php echo $value->option->value;?></td>
		  			<td><?php echo $value->date_created->format('d M Y H:i:s')?></td>
		  		</tr>
				<?php } ?>
  			</table>
      </div><!-- /.body -->
    </div><!-- /.box -->
  </div><!-- /.col-lg-12 -->
</div><!-- /.row -->