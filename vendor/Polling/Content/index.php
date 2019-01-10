<?php 
$polling = new \Polling\Main();
$pollingAnswer = new \Polling\Answer();
$pollingData = $polling->getAll();
?>

<section class="clearfix bg-white home-poll-op pv60">
  <div class="container">
    <div class="row">

			<?php 
      foreach ($pollingData as $key => $value) { 
      $hasVoted = $pollingAnswer->getMyPolling(helper::get_client_ip(), $value->id);
      ?>

      <div class="col-md-5">
        <div class="section-title">
          <h3 class="title m0"><?php echo $value->question?></h3>
        </div>
        <Br>

        <?php if(!$hasVoted):?>

        <form action="<?php BASE?>polling_post" method="POST">
					<input type="hidden" name="polling_id" value="<?php echo $value->id?>">
          <div class="form-group">
            <ol class="nav nav-stacked jkw-perform-poll">
              <?php 
                foreach ($value->option as $k => $v) { 
                  $totalvote += count($v->answer);
              ?>

              <li>
                <input id="polling_<?php echo $value->id.$v->id?>" type="radio" name="polling_val" value="<?php echo $v->id?>" class="hidden">
                <label for="polling_<?php echo $value->id.$v->id?>"><?php echo $v->value?></label>
              </li>

              <?php } ?>
            </ol>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-danger pv15 ph15">SUBMIT</button>
          </div>
        </form>

        <?php endif?>

        <?php 
        if($hasVoted):
        $totalvote = 0;
        foreach ($value->option as $k => $v) { $totalvote += count($v->answer); }
        foreach ($value->option as $k => $v) { 
          $vote = round(count($v->answer) * 100 / $totalvote);
        ?>
          <div class="progress polling">
            <div class="vote progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo count($v->answer) . "-" . $totalvote?>"
            aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $vote?>%"><span><?php echo $v->value?> <?php echo $vote?>%</span></div>
          </div>
        <?php } ?>

        <p class="text-success"><i>*Terima kasih sudah berpartisipasi dalam polling ini</i></p>
        
        <?php endif; ?>
      </div>

			<?php }?>

    </div>
  </div>
</section>