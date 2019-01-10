
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
				<div class="panel-heading">
	            <div class="panel-title">Gallery Form</div>
	        </div>

				<div class="panel-body">
					<?php 

					echo helper::flashdata('regStatus'); 

					if(Io::param('update')){
						if($ARM->mediaCategory->update()){
							helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
							header('Location: '.BASE.BACKEND.'/index.php?menu=media_category&action=edit&id=' . Io::param('id'));
						}
					}
					
					$edit = $ARM->mediaCategory->retrieve(Io::param('id'));

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

								$data = $ARM->mediaCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

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

									echo "<option value=" . $v->id . ( $edit->parent == $v->id ? ' selected' : '' ) . ">" . $strip . $v->title . "</option>";

									generateMenu($v->id, $ARM, $dash + 1);
								}
							}
							?>
						</select>
				  	</div>

				  	<div class="form-group">
				    	<label>Title : <em>*</em></label>
				    	<input name="title" type="text" class="form-control input-sm" value="<?php echo $edit->title?>" required>
				  	</div>

				  	<div class="form-group">
						<label>Description :</label>
						<textarea name="description" id="description" class="form-control input-sm texteditor">
						<?php echo $edit->description?></textarea>
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