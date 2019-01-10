<?php 
if(helper::getParam('update')){
	$ul->post->update();
}
$data = $ul->post->retrieve(helper::getParam('id'));

$category = $ul->postcategory->retrieve();
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
		            <div class="panel-title">Post Form</div>
		        </div>

				<div class="panel-body">

				  	<div class="form-group">
				    	<label>Title : <em>*</em></label>
				    	<input name="title" type="text" class="form-control input-sm" value="<?php echo $data->post_title?>" required>
				  	</div>

	            	<div class="form-group">
				    	<label>Category : <em>*</em></label>
						<select name="category" class="form-control input-sm show-tick" data-live-search="true" required>
							<option> - Select Category</option>
							<?php foreach ($category as $v) { ?>
								<option value="<?php echo $v->id?>" <?php echo $data->post_category==$v->id?"selected":""?> ><?php echo $v->cat_name?></option>
							<?php }?>
						</select>
				  	</div>

				  	<div class="form-group">
						<label>Description :</label>
						<textarea name="description" id="description" class="form-control input-sm"><?php echo $data->post_desc?></textarea>
					</div>
				  	<div class="form-group">
						<label>Content :</label>
						<textarea name="content" id="content" class="form-control input-sm texteditor"><?php echo $data->post_content?></textarea>
					</div>

				  	<div class="form-group">
				    	<label>Keyword :</label>
				    	<input name="keyword" type="text" class="form-control input-sm" value="<?php echo $data->post_keyword?>">
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
			  		if(!empty($data->post_cover_image) && file_exists(PATH.'media/upload/'.$data->post_cover_image))
			  			$file = UPLOAD.$data->post_cover_image;
			  		else
			  			$file = BASE.'images/no-image.png';
			  		?>
			    	<img id="file-preview" src="<?php echo $file?>" style="width:100%">
			  	</div>

                <div class="form-group">
                    <label>Cover Post :</label>
                    <div class="input-group">
                        <input  value="<?php echo $data->post_cover_image?>" name="file" value="" type="text" id="file" data-preview="file-preview" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=file&relative_url=1"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>

				<div class="form-group">
			    	<label>Publish Date : <em>*</em></label>
					<div class="input-group date datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss">
			    		<input name="published" type="text" class="form-control input-sm" value="<?php echo helper::datetime_parse($data->post_publish_up)?>" required>
	                    <span class="input-group-addon">
	                    	<span class="fa fa-calendar"></span>
	                    </span>
	                </div>
			  	</div>

			  	<div class="form-group">
			    	<label>Unpublish Date :</label>
					<div class="input-group date datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss">
			    		<input name="unpublished" type="text" class="form-control input-sm"  value="<?php echo helper::datetime_parse($data->post_publish_down)?>">
	                    <span class="input-group-addon">
	                    	<span class="fa fa-calendar"></span>
	                    </span>
	                </div>
			  	</div>

				<div class="form-group">
                    <label>Status : <em>*</em></label>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-enable"  value="1" <?php echo $data->post_status=='1'?'checked':''?>>
                        <label for="radio-enable"> Enable </label>
                    </div>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-disable" value="0" <?php echo $data->post_status=='0'?'checked':''?>>
                        <label for="radio-disable"> Disable </label>
                    </div>
                </div>
				</div>
        </div>
    </div>
</form>