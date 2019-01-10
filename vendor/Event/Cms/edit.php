<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">Event Form</div>
        </div>

        <div class="panel-body">
          <?php 
          $event = new Event\Main();
          $eventCategory = new Event\Category();

          echo helper::flashdata('regStatus'); 

          if(Io::param('update')){
            if($event->update()){
              helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil diupdate</div>');
              header('Location: '.BASE.BACKEND.'/index.php?menu=Event&action=edit&id=' . Io::param('id'));
            }
          }

          
          $language = $ARM->language->retrieve();

          $edit = $event->getById(helper::getParam('id'));
          ?>

          <div class="form-group">
            <label>Category : <em>*</em></label>
            <select name="category" class="form-control input-sm show-tick" data-live-search="true" required>
              <option> - Select Category - </option>

                <?php
                generateMenu(0, $eventCategory, $dash = 0);

                function generateMenu($parent = 0, $controller, $dash){
                  $conditions['parent'] = $parent;
                  $conditions['status'] = 1;

                  $d = $controller->model->find('all', array( 'conditions' => $conditions, 'order' => 'id asc'));

                  if($d){
                    buildMenu($d, $controller, $dash);
                  }
                }

                function buildMenu($d, $controller, $dash)
                {
                  global $edit;

                  foreach ($d as $k => $v) {
                    $strip = "";
                    for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                    echo "<option value='" . $v->id . "' " . ($edit->category_id == $v->id ? "selected" : "") . ">" . $strip . $controller->Detail->getTitle($v->id, 1) . "</option>";

                    generateMenu($v->id, $controller, $dash + 1);
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
                      <input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm" value="<?php echo $event->Detail->getTitle($edit->id, $value->id)?>" required>
                    </div>

                    <div class="form-group">
                      <label>Content (<?php echo $value->nama?>):</label>
                      <textarea name="content_<?php echo $value->kode?>" id="content_<?php echo $value->kode?>" class="form-control input-sm texteditor"><?php echo $event->Detail->getContent($edit->id, $value->id)?></textarea>
                    </div>

                    <div class="form-group">
                      <label>Summary (<?php echo $value->nama?>):</label>
                      <textarea name="excerpt_<?php echo $value->kode?>" id="excerpt_<?php echo $value->kode?>" class="form-control input-sm"><?php echo $event->Detail->getExcerpt($edit->id, $value->id)?></textarea>
                    </div>
                  </div>
                </div>
              <?php }?>

            </div>
          </div>

          <div class="form-group">
              <label>Contact Detail : <em>*</em></label>
              <textarea name="contact" id="contact" class="form-control input-sm texteditor"><?php echo $edit->contact?></textarea>
          </div>


          <div class="form-group">
              <label>Tags : <em>*</em></label>
              <input type="text" name="tags" id="input-tags" class="form-control" value="<?php echo $edit->tags?>">
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
                    <label>Event Organizer : </label>
                    <input name="event_organizer" value="<?php echo $edit->event_organizer?>" type="text" class="form-control input-sm">
                </div>

                <div class="form-group">
                    <label>Ticket Price : </label>
                    <input name="ticket_price" value="<?php echo $edit->ticket_price?>" type="text" class="form-control input-sm">
                </div>

                <div class="form-group">
                    <label>Venue & Location : </label>
                    <input name="location" type="text" class="form-control input-sm" value="<?php echo $edit->location?>">
                </div>

                <div class="form-group">
                    <label>Maps Widget : </label>
                    <textarea name="ticket_maps_widget" id="ticket_maps_widget" class="form-control input-sm"><?php echo $edit->ticket_maps_widget?></textarea>
                </div>

                <div class="form-group">
                    <label>Ticket URL : </label>
                    <input name="ticket_url" type="text" class="form-control input-sm" value="<?php echo $edit->ticket_url?>">
                </div>

                <div class="form-group">
                    <label>Start Date :</label>
                    <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                        <input name="start_date" type="text" class="form-control input-sm" value="<?php echo helper::datetime_parse($edit->start_date)?>">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>End Date :</label>
                    <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                        <input name="end_date" type="text" class="form-control input-sm" value="<?php echo helper::datetime_parse($edit->end_date)?>">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Time : </label>
                    <input name="event_time" value="<?php echo $edit->event_time?>" type="text" class="form-control input-sm">
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