
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
	            <div class="panel-title">Artist Form</div>
	        </div>

				<div class="panel-body">
					<?php 
					$controller = new ArtistWishlist\Main();

					echo helper::flashdata('regStatus'); 

					if(Io::param('update')){
						if($controller->update()){
							helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
							header('Location: '.BASE.BACKEND.'/index.php?menu=ArtistWishlist&sub=artist&action=edit&id=' . Io::param('id'));
						}
					}
					
					$edit = $controller->getById(Io::param('id'));

					?>

				  	<div class="form-group">
				    	<label>Title : <em>*</em></label>
				    	<input name="name" type="text" class="form-control input-sm" value="<?php echo $edit->name?>" required>
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