<?php 
if(Io::param('save')){
	if($ARM->admin->save()){
		helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan</div>');
		echo "<script>window.location='index.php?menu=admin'</script>";
	}
}

?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
		            <div class="panel-title">Menu Builder</div>
		        </div>

				<div class="panel-body">
				 	<?php echo validation::error_message(); ?>

				  	<div class="form-group">
				    	<label>Full Name : <em>*</em></label>
				    	<input name="fullname" type="text" class="form-control input-sm" value="<?=helper::getParam('fullname')?>" required>
				  	</div>

				  	<div class="form-group">
				    	<label>Initial : <em>*</em></label>
				    	<input name="initial" type="text" class="form-control input-sm" value="<?=helper::getParam('initial')?>" required>
				  	</div>

				  	<div class="form-group">
				    	<label>Email :</label>
				    	<input name="email" type="text" class="form-control input-sm" value="<?=helper::getParam('email')?>">
				  	</div>

				  	<div class="form-group">
				    	<label>Username : <em>*</em></label>
				    	<input name="username" type="text" class="form-control input-sm" value="<?=helper::getParam('username')?>" required>
				  	</div>

				  	<div class="form-group">
				    	<label>Password : <em>*</em></label>
				    	<input name="password" type="password" class="form-control input-sm" required>
				  	</div>

				  	<div class="form-group">
				    	<label>Re-type Password : <em>*</em></label>
				    	<input name="re_password" type="password" class="form-control input-sm" required>
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
				    	<label>Role : <em>*</em></label>
						<select name="role" class="form-control input-sm show-tick" data-live-search="true" required>
						<?php 
						$role = new \Ma\Model\Admin\Category();
						foreach ($role->find("all") as $key => $value) { ?>
							<option value="<?php echo $value->id?>"><?php echo $value->name?></option>
						<?php }?>
						</select>
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