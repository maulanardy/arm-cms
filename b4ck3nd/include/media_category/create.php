<?php 
if(helper::getParam('save')){
	if($ARM->mediaCategory->save()){
		helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan</div>');
		echo "<script>window.location='index.php?menu=media_category'</script>";
	}
}
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
	            <div class="panel-title">Media Category</div>
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

								$data = $ARM->mediaCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

								if($data){
									buildMenu($data, $ARM, $dash);
								}
							}

							function buildMenu($data, $ARM, $dash)
							{
								foreach ($data as $k => $v) {
									$strip = "";
									for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

									echo "<option value='" . $v->id . "'>" . $strip . $v->title . "</option>";

									generateMenu($v->id, $ARM, $dash + 1);
								}
							}
							?>
						</select>
				  	</div>

				  	<div class="form-group">
				    	<label>Title : <em>*</em></label>
				    	<input name="title" type="text" class="form-control input-sm" required>
				  	</div>

				  	<div class="form-group">
						<label>Description :</label>
						<textarea name="description" id="description" class="form-control input-sm texteditor"></textarea>
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

				<div class="form-group">
                    <label>Status : <em>*</em></label>
                    <div class="radio">
                        <input name="status" type="radio" id="radio-enable"  value="1">
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