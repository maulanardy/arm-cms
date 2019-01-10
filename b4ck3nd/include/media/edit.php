
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
	            <div class="panel-title">Media Form</div>
	        </div>

				<div class="panel-body">
				<?php 

					echo helper::flashdata('regStatus'); 

					if(Io::param('update')){
						if($ARM->media->update()){
							helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
							header('Location: '.BASE.BACKEND.'/index.php?menu=media&action=edit&id=' . Io::param('id'));
						}
					}
					
					$data = $ARM->media->retrieve(Io::param('id'));

					$category = $ARM->mediaCategory->retrieve();
				?>

			  	<div class="form-group">
			    	<label>Title : <em>*</em></label>
			    	<input name="title" type="text" class="form-control input-sm" value="<?php echo $data->title?>" required>
			  	</div>

            	<div class="form-group">
			    	<label>Category : <em>*</em></label>

		            <select name="category" class="form-control input-sm show-tick" data-live-search="true" required>
		              <option> - Select Category - </option>

		                <?php
		                generateMenu(0, $ARM, $dash = 0);

		                function generateMenu($parent = 0, $ARM, $dash){
		                  $conditions['parent'] = $parent;
		                  $conditions['status'] = 1;

		                  $d = $ARM->mediaCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

		                  if($d){
		                    buildMenu($d, $ARM, $dash);
		                  }
		                }

		                function buildMenu($d, $ARM, $dash)
		                {
		                  global $data;

		                  foreach ($d as $k => $v) {
		                    $strip = "";
		                    for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

		                    echo "<option value='" . $v->id . "' " . ($data->category_id == $v->id ? "selected" : "") . ">" . $strip . $v->title . "</option>";

		                    generateMenu($v->id, $ARM, $dash + 1);
		                  }
		                }
		                ?>
		            </select>
			  	</div>

			  	<div class="form-group">
			    	<label>URL : <em>*</em></label>
			    	<input name="url" type="text" class="form-control input-sm" value="<?php echo $data->url?>" required>
			  	</div>

			  	<div class="form-group">
					<label>Content :</label>
					<textarea name="content" id="content" class="form-control input-sm texteditor">
					<?php echo $data->content?></textarea>
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
			  		if(file_exists(PATH.'media/upload/'.$data->file))
			  			$file = UPLOAD.$data->file;
			  		else
			  			$file = BASE.'images/no-image.png';
			  		?>
			    	<img id="file-preview" src="<?php echo $file?>" style="width:100%">
			  	</div>

                <div class="form-group">
                    <label>Server Upload : <em>*</em></label>
                    <div class="input-group">
                        <input name="file" value="<?php echo $data->file?>" type="text" id="file" data-preview="file-preview" class="form-control input-sm" required>
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=file&relative_url=1"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>

				<div class="form-group">
                    <label>Status : <em>*</em></label>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-enable"  value="1" <?php echo $data->status=='1'?'checked':''?>>
                        <label for="radio-enable"> Enable </label>
                    </div>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-disable" value="0" <?php echo $data->status=='0'?'checked':''?>>
                        <label for="radio-disable"> Disable </label>
                    </div>
                </div>
				</div>
        </div>
    </div>
</form>