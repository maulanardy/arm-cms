
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
		            <div class="panel-title">Post Category Form</div>
		        </div>

				<div class="panel-body">
					<?php 

					echo helper::flashdata('regStatus'); 

					if(Io::param('update')){
						if($ARM->postsCategory->update()){
							helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
							header('Location: '.BASE.BACKEND.'/index.php?menu=postcategory&action=edit&id=' . Io::param('id'));
						}
					}
					
					$language = $ARM->language->retrieve();

					$edit = $ARM->postsCategory->retrieve(Io::param('id'));
					?>

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
								global $edit;
								
								foreach ($data as $k => $v) {
									$strip = "";
									for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

									echo "<option value=" . $v->id . ( $edit->parent == $v->id ? ' selected' : '' ) . ">" . $strip . $ARM->posts->Category->Detail->getTitle($v->id, 1) . "</option>";

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
						    	<input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm" value="<?php echo $ARM->posts->Category->Detail->getTitle($edit->id, $value->id)?>" required>
						  	</div>

						  	<div class="form-group">
								<label>Description :</label>
								<textarea name="description_<?php echo $value->kode?>" id="description_<?php echo $value->kode?>" class="form-control input-sm"><?php echo $ARM->posts->Category->Detail->getDescription($edit->id, $value->id)?></textarea>
							</div>

		                  </div>
		                
		                <?php }?>
					    
					  </div>
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
			  		<?php 
			  		if(!empty($edit->picture) && file_exists(PATH.'media/upload/'.$edit->picture))
			  			$file = UPLOAD.$edit->picture;
			  		else
			  			$file = BASE.'images/no-image.png';
			  		?>
			    	<img id="file-preview" src="<?php echo $file?>" style="width:100%">
			  	</div>

                <div class="form-group">
                    <label>Category Image :</label>
                    <div class="input-group">
                        <input  value="<?php echo $edit->picture?>" name="file" value="" type="text" id="file" data-preview="file-preview" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=file&relative_url=1"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>


				<div class="form-group">
                    <label>Status : <em>*</em></label>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-enable"  value="1" <?php echo $edit->status=='1'?'checked':''?>>
                        <label for="radio-enable"> Enable </label>
                    </div>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-disable" value="0" <?php echo $edit->status=='0'?'checked':''?>>
                        <label for="radio-disable"> Disable </label>
                    </div>
                </div>
				</div>
        </div>
    </div>
</form>