<?php 
$hashtag = new \Ma\Model\Posts\Hashtag();
$query = $hashtag->find("all", array("order" => "name asc")); 

foreach ($query as $key => $value) {
  $hashtag_arr[] = '"'.$value->name.'"';
}

?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">Post Form</div>
        </div>

        <div class="panel-body">
          <?php 

          echo helper::flashdata('regStatus'); 

          if(Io::param('update')){
            if($ARM->posts->update()){
              helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
              header('Location: '.BASE.BACKEND.'/index.php?menu=post&action=edit&id=' . Io::param('id'));
            }
          }

          if(Io::param('updateOnly')){
            if($ARM->posts->updateOnly()){
              header('Location: '.BASE.BACKEND.'/index.php?menu=post&action=edit&id=' . Io::param('id'));
            }
          }

          
          $language = $ARM->language->retrieve();

          $edit = $ARM->posts->retrieve(helper::getParam('id'));

          $category = $ARM->postsCategory->retrieve();
          $gallery = $ARM->mediaCategory->retrieve();
          ?>

          <div class="form-group">
            <label>Category : <em>*</em></label>
            <select name="category" class="form-control input-sm show-tick" data-live-search="true" required>
              <option> - Select Category - </option>

                <?php
                generateMenu(0, $ARM, $dash = 0);

                function generateMenu($parent = 0, $ARM, $dash){
                  $conditions['parent'] = $parent;
                  $conditions['status'] = 1;

                  $d = $ARM->postsCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

                  if($d){
                    buildMenu($d, $ARM, $dash);
                  }
                }

                function buildMenu($d, $ARM, $dash)
                {
                  global $edit;

                  foreach ($d as $k => $v) {
                    $strip = "";
                    for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                    echo "<option value='" . $v->id . "' " . ($edit->category_id == $v->id ? "selected" : "") . ">" . $strip . $ARM->posts->Category->Detail->getTitle($v->id, 1) . "</option>";

                    generateMenu($v->id, $ARM, $dash + 1);
                  }
                }
                ?>
            </select>
          </div>

          <div class="form-group">
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
                      <input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm" value="<?php echo $ARM->posts->Detail->getTitle($edit->id, $value->id)?>" required>
                    </div>

                    <div class="form-group">
                      <label>Content (<?php echo $value->nama?>):</label>
                      <textarea name="content_<?php echo $value->kode?>" id="content_<?php echo $value->kode?>" class="form-control input-sm texteditor"><?php echo $ARM->posts->Detail->getContent($edit->id, $value->id)?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Summary (<?php echo $value->nama?>):</label>
                      <textarea name="excerpt_<?php echo $value->kode?>" id="excerpt_<?php echo $value->kode?>" class="form-control input-sm"><?php echo $ARM->posts->Detail->getExcerpt($edit->id, $value->id)?></textarea>
                    </div>
                  </div>
                </div>
              <?php }?>

            </div>
          </div>

          <div class="form-group">
              <label>Tags : <em>*</em></label>
              <input type="text" name="tags" id="input-tags" class="form-control" value="<?php echo $edit->tags?>">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
    <?php if($edit->status == 0){ ?>

    <input class="btn btn-sm btn-block btn-success" type="submit" name="update" value="Save & Publish">
    <input class="btn btn-sm btn-block btn-default" type="submit" name="updateOnly" value="Save">

    <?php } else {?>
    <input class="btn btn-sm btn-block btn-primary" type="submit" name="update" value="Update">
    <?php } ?>

    <hr>

        <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-gear"></i> Attribute</div>
        </div>

        <script type="text/javascript">
          var hashtagSource = [<?php echo implode (",", $hashtag_arr);?>];
        </script>

        <div class="panel-body">
            <div class="form-group">
                <label>HashTag : <em>*</em></label>
                <div class="input-group">
                  <div class="input-group-addon">#</div>
                  <input type="text" name="hashtag" id="hashtag" class="form-control" value="<?php echo $edit->hashtag?>">
                </div>
            </div>

            <div class="form-group">

                <label>Position : <em>*</em></label>
                <?php
                $position_id = array();

                foreach($edit->position_relation as $k_rel => $v_rel){
                  $position_id[] = $v_rel->posts_position_id;
                }
                
                $data = \Ma\Model\Posts\Position::find('all', array( 'conditions' => array('status = 1'), 'order' => 'title asc'));

                foreach ($data as $k => $v) {
                  echo "<div class='checkbox checkbox-success'>";
                  echo "<input id='checkbox_$v->id' type='checkbox' name='position[]' value='$v->id' ".(in_array($v->id, $position_id)?"checked":"").">";
                  echo "<label for='checkbox_$v->id'>";
                  echo $v->title;
                  echo "</label>";
                  echo "</div>";
                }

                ?>

            </div>

              <div class="form-group">
            <label>Template : <em>*</em></label>
          <select id="template-option" name="template" class="form-control input-sm show-tick" data-live-search="true">
            <option value="default" <?php echo $edit->template=="default"?"selected":""?> >Post Default</option>
            <option value="gallery" <?php echo $edit->template=="gallery"?"selected":""?> >Gallery Album</option>
            <option value="video"<?php echo $edit->template=="video"?"selected":""?>>Video Player</option>
            <option value="youtube" <?php echo $edit->template=="youtube"?"selected":""?> >Youtube Player</option>
            <option value="registration" <?php echo $edit->template=="registration"?"selected":""?> >Post Registration</option>
            <option value="document" <?php echo $edit->template=="document"?"selected":""?> >Download Page</option>
          </select>
          </div>

          <div class="form-group">
            <?php 
            if(!empty($edit->featured_image) && file_exists(PATH.'media/upload/'.$edit->featured_image))
              $file = UPLOAD.$edit->featured_image;
            else
              $file = BASE.'images/no-image.png';
            ?>
            <img id="file-preview" src="<?php echo $file?>" style="width:100%">
          </div>

                <div class="form-group">
                    <label>Cover Post :</label>
                    <div class="input-group">
                        <input  value="<?php echo $edit->featured_image?>" name="file" value="" type="text" id="file" data-preview="file-preview" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=file&type=1&relative_url=1"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>

          <div class="form-group">
              <label>Media Caption :</label>
              <input name="media_caption" value="<?php echo $edit->media_caption?>" type="text" class="form-control input-sm">
          </div>

                <div class="form-group video-option">
                    <label>Video File :</label>
                    <div class="input-group">
                        <input name="video" value="<?php echo $edit->video?>" type="text" id="video" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=video&type=3&relative_url=1"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>

                <div class="form-group document-option">
                    <label>Document :</label>
                    <div class="input-group">
                        <input name="document" value="<?php echo $edit->document?>" type="text" id="document" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=document&relative_url=1"><i class="fa fa-file"></i></a>
                    </div>
                </div>

              <div class="form-group gallery-option">
            <label>Gallery : <em>*</em></label>
          <select name="gallery" class="form-control input-sm show-tick" data-live-search="true" required>
            <option> - Select Gallery</option>
            <?php foreach ($gallery as $v) { ?>
              <option value="<?php echo $v->id?>" <?php echo $edit->gallery_id==$v->id?"selected":""?> ><?php echo $v->title?></option>
            <?php }?>
          </select>
          </div>

                <div class="form-group youtube-option">
                    <label>Youtube URL :</label>
                    <input name="youtube" value="<?php echo $edit->youtube?>" type="text" id="youtube" class="form-control input-sm">
                </div>

        <div class="form-group">
            <label>Publish Date : <em>*</em></label>
          <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
              <input name="published" type="text" class="form-control input-sm" value="<?php echo helper::datetime_parse($edit->date_publish)?>" required>
                      <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                      </span>
                  </div>
          </div>

          <div class="form-group">
            <label>Unpublish Date :</label>
          <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
              <input name="unpublished" type="text" class="form-control input-sm"  value="<?php echo ($edit->date_unpublish?helper::datetime_parse($edit->date_unpublish):'')?>">
                      <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                      </span>
                  </div>
          </div>

            <div class="form-group">
                <label>Featured :</label>
                <div class="checkbox checkbox-primary">
                    <input id="featured" name="featured" type="checkbox" value="1" <?php echo $edit->featured=='1'?'checked':''?>>
                    <label for="featured"> Featured Content </label>
                </div>
                <div class="checkbox checkbox-primary">
                    <input id="highlight" name="highlight" type="checkbox" value="1" <?php echo $edit->highlight=='1'?'checked':''?>>
                    <label for="highlight"> Highlight on Menu </label>
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