<?php 
if(helper::getParam('save')){
	if($ul->post->save())
		echo "<script>window.location='index.php?menu=post'</script>";
}

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
				    	<input name="title" type="text" class="form-control input-sm" required>
				  	</div>

	            	<div class="form-group">
				    	<label>Category : <em>*</em></label>
						<select name="category" class="form-control input-sm show-tick" data-live-search="true" required>
							<option> - Select Category</option>
							<?php foreach ($category as $v) { ?>
								<option value="<?php echo $v->id?>"><?php echo $v->cat_name?></option>
							<?php }?>
						</select>
				  	</div>

				  	<div class="form-group">
						<label>Description :</label>
						<textarea name="description" id="description" class="form-control input-sm"></textarea>
					</div>
				  	<div class="form-group">
						<label>Content :</label>
						<textarea name="content" id="content" class="form-control input-sm texteditor"></textarea>
					</div>

				  	<div class="form-group">
				    	<label>Keyword :</label>
				    	<input name="keyword" type="text" class="form-control input-sm">
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
                    <label>Cover Post : </label>
                    <div class="input-group">
                        <input name="file" value="" type="text" id="file" data-preview="file-preview" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=file&relative_url=1"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>

				<div class="form-group">
			    	<label>Publish Date : <em>*</em></label>
					<div class="input-group date datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss">
			    		<input name="published" type="text" class="form-control input-sm" required>
	                    <span class="input-group-addon">
	                    	<span class="fa fa-calendar"></span>
	                    </span>
	                </div>
			  	</div>

			  	<div class="form-group">
			    	<label>Unpublish Date :</label>
					<div class="input-group date datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss">
			    		<input name="unpublished" type="text" class="form-control input-sm">
	                    <span class="input-group-addon">
	                    	<span class="fa fa-calendar"></span>
	                    </span>
	                </div>
			  	</div>

				<div class="form-group">
                    <label>Status : <em>*</em></label>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-enable"  value="1">
                        <label for="radio-enable"> Enable </label>
                    </div>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-disable" value="0" checked>
                        <label for="radio-disable"> Disable </label>
                    </div>
                </div>
				</div>
        </div>
    </div>
</form>