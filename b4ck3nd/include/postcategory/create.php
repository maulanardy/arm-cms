<?php 
if(helper::getParam('save')){
	if($ARM->postsCategory->save()){
		helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan</div>');
		echo "<script>window.location='index.php?menu=postcategory'</script>";
	}
}
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
		            <div class="panel-title">Post Category Form</div>
		        </div>

				<div class="panel-body">

	            	<div class="form-group">
				    	<label>Parent : <em>*</em></label>
						<select name="parent" class="form-control input-sm show-tick" data-live-search="true" required>
							<option>No Parent</option>

				  			<?php
							generateMenu(0, $ARM, $dash = 0);

							function generateMenu($parent = 0, $ARM, $dash){
								$conditions['parent'] = $parent;
								$conditions['status'] = 1;

								$data = $ARM->postsCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

								if($data){
									buildMenu($data, $ARM, $dash);
								}
							}

							function buildMenu($data, $ARM, $dash)
							{
								foreach ($data as $k => $v) {
									$strip = "";
									for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

									echo "<option value='" . $v->id . "'>" . $strip . $ARM->posts->Category->Detail->getTitle($v->id, 1)  . "</option>";

									generateMenu($v->id, $ARM, $dash + 1);
								}
							}
							?>
						</select>
				  	</div>

				  	<div class="form-group">
				  	  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">

		                <?php foreach ($ARM->language->retrieve() as $key => $value) { ?>

		                  <li class="<?php echo $key > 0 ? '' : 'active'?>"><a href="#<?php echo $value->kode?>" aria-controls="<?php echo $value->kode?>" role="tab" data-toggle="tab"><?php echo $value->nama?></a></li>
		                
		                <?php }?>
					    
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content language">

		                <?php foreach ($ARM->language->retrieve() as $key => $value) { ?>

		                  <div role="tabpanel" class="tab-pane <?php echo $key > 0 ? '' : 'active'?>" id="<?php echo $value->kode?>">
				    
						  	<div class="form-group">
						    	<label>Title : <em>*</em></label>
						    	<input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm" required>
						  	</div>

						  	<div class="form-group">
								<label>Description :</label>
								<textarea name="description_<?php echo $value->kode?>" id="description_<?php echo $value->kode?>" class="form-control input-sm"></textarea>
							</div>

		                  </div>
		                
		                <?php }?>
					    
					  </div>
					</div>
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
			    	<img id="file-preview" src="<?php echo BASE?>images/no-image.png" style="width:100%">
			  	</div>

                <div class="form-group">
                    <label>Category Image : </label>
                    <div class="input-group">
                        <input name="file" value="" type="text" id="file" data-preview="file-preview" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=file&relative_url=1"><i class="fa fa-picture-o"></i></a>
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