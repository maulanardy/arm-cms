<?php 
$polling = new \Polling\Main();

if(Io::param('save')){
  if($polling->insert()){
      helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Polling baru berhasil ditambahkan</div>');
      echo "<script>window.location='index.php?menu=polling'</script>";
  }
}
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
      <div class="panel panel-default">
				<div class="panel-heading">
            <div class="panel-title">Polling Form</div>
        </div>

				<div class="panel-body">


				  	<div class="form-group">
				    	<label>Title : <em>*</em></label>
				    	<input name="title" type="text" class="form-control input-sm" required>
				  	</div>

				  	<div class="form-group">
							<label>Question :</label>
							<textarea name="question" id="question" class="form-control input-sm"></textarea>
						</div>

            <div class="form-group">
              <label>Option : <small>hit enter for multiple option</small></label>
              <input type="text" name="option" id="input-tags" data-placeholder="Option" class="form-control" value="" required>
            </div><!-- /.form-group -->

				</div>
      </div>
    </div>
    <div class="col-md-3">
		<input class="btn btn-sm btn-block btn-primary" type="submit" name="save" value="Save">

		<hr>

        <div class="panel panel-default">
				<div class="panel-heading">
	            <div class="panel-title"><i class="fa fa-gear"></i> Attribute</div>
	        </div>

				<div class="panel-body">

          <div class="form-group">
              <label>Publish Date :</label>
              <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                  <input name="date_publish" type="text" class="form-control input-sm" value="<?php echo date("Y-m-d")?>">
                  <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                  </span>
              </div>
          </div>

          <div class="form-group">
              <label>Featured :</label>
              <div class="checkbox checkbox-primary">
                  <input id="featured" name="featured" type="checkbox" value="1">
                  <label for="featured"> Featured Polling </label>
              </div>
          </div>

					<div class="form-group">
              <label>Status : <em>*</em></label>
              <div class="radio">
                  <input name="status" type="radio" id="radio-enable"  value="1" checked>
                  <label for="radio-enable"> Enable </label>
              </div>
              <div class="radio">
                  <input name="status" type="radio" id="radio-disable" value="0">
                  <label for="radio-disable"> Disable </label>
              </div>
          </div>
				</div>
        </div>
    </div>
</form>