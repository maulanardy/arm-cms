<?php 
$polling = new \Polling\Main();
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
      <div class="panel panel-default">
				<div class="panel-heading">
            <div class="panel-title">Polling Edit Form</div>
        </div>

				<div class="panel-body">

          <?php 

          echo helper::flashdata('regStatus'); 

          if(Io::param('update')){
            if($polling->update()){
              helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Polling berhasil diupdate</div>');
              header('Location: '.BASE.BACKEND.'/index.php?menu=polling&action=edit&id=' . Io::param('id'));
            }
          }

          $edit = $polling->getById(helper::getParam('id'));
          ?>


				  	<div class="form-group">
				    	<label>Title : <em>*</em></label>
				    	<input name="title" type="text" class="form-control input-sm" value="<?php echo $edit->title?>" required>
				  	</div>

				  	<div class="form-group">
							<label>Question :</label>
							<textarea name="question" id="question" class="form-control input-sm"><?php echo $edit->question?></textarea>
						</div>

				</div>
      </div>
    </div>
    <div class="col-md-3">
		<input class="btn btn-sm btn-block btn-primary" type="submit" name="update" value="Update">

		<hr>

        <div class="panel panel-default">
				<div class="panel-heading">
	            <div class="panel-title"><i class="fa fa-gear"></i> Attribute</div>
	        </div>

				<div class="panel-body">

          <div class="form-group">
              <label>Publish Date :</label>
              <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                  <input name="date_publish" type="text" class="form-control input-sm" value="<?php echo date("Y-m-d", strtotime($edit->date_publish))?>">
                  <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                  </span>
              </div>
          </div>

          <div class="form-group">
              <label>Featured :</label>
              <div class="checkbox checkbox-primary">
                  <input id="featured" name="featured" type="checkbox" value="1" <?php echo $edit->is_featured=='1'?'checked':''?>>
                  <label for="featured"> Featured Polling </label>
              </div>
          </div>

					<div class="form-group">
              <label>Status : <em>*</em></label>
              <div class="radio">
                  <input name="status" type="radio" id="radio-enable"  value="1" <?php echo $edit->is_active=='1'?'checked':''?>>
                  <label for="radio-enable"> Enable </label>
              </div>
              <div class="radio">
                  <input name="status" type="radio" id="radio-disable" value="0" <?php echo $edit->is_active=='0'?'checked':''?>>
                  <label for="radio-disable"> Disable </label>
              </div>
          </div>
				</div>
        </div>
    </div>
</form>