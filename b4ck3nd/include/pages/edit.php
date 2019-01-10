
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Post Form</div>
                </div>

                <div class="panel-body">
                  <?php 

                  echo helper::flashdata('regStatus'); 

                  if(Io::param('update')){
                    if($ARM->pages->update()){
                      helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
                      header('Location: '.BASE.BACKEND.'/index.php?menu=pages&action=edit&id=' . Io::param('id'));
                    }
                  }
                  
                  $language = $ARM->language->retrieve();

                  $data = $ARM->pages->retrieve(Io::param('id'));
                  ?>
            
                      <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">

                    <?php foreach ($language as $key => $value) { ?>

                      <li class="<?php echo $key > 0 ? '' : 'active'?>"><a href="#<?php echo $value->kode?>" aria-controls="<?php echo $value->kode?>" role="tab" data-toggle="tab"><?php echo $value->nama?></a></li>

                    <?php }?>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content language">

                        <?php foreach ($language as $key => $value) { ?>

                          <div role="tabpanel" class="tab-pane <?php echo $key > 0 ? '' : 'active'?>" id="<?php echo $value->kode?>">
                                  
                            <div class="form-group">
                              <div class="form-group">
                                  <label>Title (<?php echo $value->nama?>): <em>*</em></label>
                                  <input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm" value="<?php echo $ARM->pages->Detail->getTitle($data->id, $value->id)?>" required>
                              </div>

                              <div class="form-group">
                                  <label>Content (<?php echo $value->nama?>):</label>
                                  <textarea name="content_<?php echo $value->kode?>" id="content_<?php echo $value->kode?>" class="form-control input-sm texteditor"><?php echo $ARM->pages->Detail->getContent($data->id, $value->id)?></textarea>
                              </div>

                              <div class="form-group">
                                  <label>Excerpt (<?php echo $value->nama?>):</label>
                                  <textarea name="excerpt_<?php echo $value->kode?>" id="excerpt_<?php echo $value->kode?>" class="form-control input-sm"><?php echo $ARM->pages->Detail->getExcerpt($data->id, $value->id)?></textarea>
                              </div>
                            </div>

                          </div>

                        <?php }?>

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
                    if(!empty($data->featured_image) && file_exists(PATH.'media/upload/'.$data->featured_image))
                        $file = UPLOAD.$data->featured_image;
                    else
                        $file = BASE.'images/no-image.png';
                    ?>
                    <img id="file-preview" src="<?php echo $file?>" style="width:100%">
                </div>

                <div class="form-group">
                    <label>Cover Post :</label>
                    <div class="input-group">
                        <input  value="<?php echo $data->featured_image?>" name="file" value="" type="text" id="file" data-preview="file-preview" class="form-control input-sm">
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