<?php 
if(Io::param('update')){
    $ARM->menu->update();
}
$pages = $ARM->pages->retrieve();
$edit = $ARM->menu->retrieve(Io::param('id'));
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Menu Builder</div>
                </div>

                <div class="panel-body">

                    <div class="form-group">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">

                        <?php foreach ($ARM->language->retrieve() as $key => $value) { ?>

                          <li class="<?php echo $key > 0 ? '' : 'active'?>"><a href="#<?php echo $value->kode?>" aria-controls="<?php echo $value->kode?>" role="tab" data-toggle="tab"><?php echo $value->nama?></a></li>
                        
                        <?php }?>
                        
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content language">

                        <?php foreach ($ARM->language->retrieve() as $key => $value) { ?>

                          <div role="tabpanel" class="tab-pane <?php echo $key > 0 ? '' : 'active'?>" id="<?php echo $value->kode?>">
                                  
                            <div class="form-group">
                                <label>Title <?php echo $value->nama?>: <em>*</em></label>
                                <input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm" value="<?php echo $ARM->menu->Detail->getTitle($edit->id, $value->id)?>" required>
                            </div>

                          </div>
                        
                        <?php }?>
                        
                      </div>
                    </div>


                    <div class="form-group">
                        <label>Parent : <em>*</em></label>
                        <select name="parent" class="form-control input-sm show-tick" data-live-search="true" required>
                            <option>No Parent</option>

                            <?php
                            generateMenu(0, $ARM, $dash = 0);

                            function generateMenu($parent = 0, $ARM, $dash){
                                $conditions['parent'] = $parent;
                                $conditions['status'] = 1;

                                $data = $ARM->menu->model->find('all', array( 'conditions' => $conditions, 'order' => 'sort asc'));

                                if($data){
                                    buildMenu($data, $ARM, $dash);
                                }
                            }

                            function buildMenu($data, $ARM, $dash)
                            {
                                global $edit;
                                
                                foreach ($data as $k => $v) {
                                    if($v->id != $edit->id){
                                        $strip = "";
                                        for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                                        echo "<option value='" . $v->id . "'" . ( $edit->parent == $v->id ? ' selected' : '' ) . ">" . $strip . $ARM->menu->Detail->getTitle($v->id, 1) . "</option>";

                                        generateMenu($v->id, $ARM, $dash + 1);
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Navigation Type : <em>*</em></label>
                        <select id="nav-type" name="link_to" class="form-control input-sm show-tick" data-live-search="true" required>
                            <option value="direct" <?php echo $edit->link_to == "direct" ? "selected" : "" ?>> Direct Link </option>
                            <option value="page" <?php echo $edit->link_to == "page" ? "selected" : "" ?>> Static Page </option>
                            <option value="category" <?php echo $edit->link_to == "category" ? "selected" : "" ?>> Post Category </option> 
                            <option value="media" <?php echo $edit->link_to == "media" ? "selected" : "" ?>> Media </option> 
                        </select>
                    </div>


                    <div class="form-group direct-option">
                        <label>URL :</label>
                        <input name="link_value" type="text" class="form-control input-sm" value="<?php echo $edit->link_value?>">
                    </div>
                    <div class="form-group page-option">
                        <label>Static Pages :</label>
                        <select name="static_pages" class="form-control input-sm show-tick" data-live-search="true">
                            <option value=""> - Select Page - </option>
                            <?php foreach ($pages as $key => $value) { ?>
                                <option value="<?php echo $value->id?>"  <?php echo $edit->pages_id == $value->id ? "selected" : "" ?>><?php echo $ARM->pages->Detail->getTitle($value->id, 1);?></option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="form-group category-option">
                        <label>Category :</label>
                        <select name="category" class="form-control input-sm show-tick" data-live-search="true">
                            <option> - Select Category - </option>

                            <?php
                            generateCategory(0, $ARM, $dash = 0);

                            function generateCategory($parent = 0, $ARM, $dash){
                                $conditions['parent'] = $parent;
                                $conditions['status'] = 1;

                                $data = $ARM->postsCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

                                if($data){
                                    buildCategory($data, $ARM, $dash);
                                }
                            }

                            function buildCategory($data, $ARM, $dash)
                            {
                                global $edit;

                                foreach ($data as $k => $v) {
                                    $strip = "";
                                    for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                                    echo "<option value='" . $v->id . "'" . ( $edit->category_id == $v->id ? ' selected' : '' ) . ">" . $strip . $ARM->posts->Category->Detail->getTitle($v->id, 1) . "</option>";

                                    generateCategory($v->id, $ARM, $dash + 1);
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group media-option">
                        <label>Media Category :</label>
                        <select name="media_category" class="form-control input-sm show-tick" data-live-search="true">
                            <option> - Select Media - </option>

                            <?php
                            generateMedia(0, $ARM, $dash = 0);

                            function generateMedia($parent = 0, $ARM, $dash){
                                $conditions['parent'] = $parent;
                                $conditions['status'] = 1;

                                $data = $ARM->mediaCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

                                if($data){
                                    buildMedia($data, $ARM, $dash);
                                }
                            }

                            function buildMedia($data, $ARM, $dash)
                            {
                                global $edit;

                                foreach ($data as $k => $v) {
                                    $strip = "";
                                    for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                                    echo "<option value='" . $v->id . "'" . ( $edit->media_id == $v->id ? ' selected' : '' ) . ">" . $strip . $v->title . "</option>";

                                    generateMedia($v->id, $ARM, $dash + 1);
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group category-option">
                        <label>Child Option:</label>

                        <div class="radio">
                            <input type="radio" name="child_option" id="child_option_1" value="no_child" <?php echo ( $edit->child_option == "no_child" ? ' checked' : '' )?>>
                            <label for="child_option_1">No Child</label>
                        </div>
                        <div class="radio">                       
                            <input type="radio" name="child_option" id="child_option_2" value="category" <?php echo ( $edit->child_option == "category" ? ' checked' : '' )?>>
                            <label for="child_option_2">Sub Category</label>                       
                        </div>
                        <div class="radio">
                            <input type="radio" name="child_option" id="child_option_3" value="top_post" <?php echo ( $edit->child_option == "top_post" ? ' checked' : '' )?>>
                          <label for="child_option_3">Highlighted post</label>
                        </div>
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
                    <label>Sort : <em>*</em></label>
                    <select name="sort" class="form-control input-sm show-tick" data-live-search="true" required>
                        <?php for ($i=1; $i <= 100 ; $i++) { 
                            echo "<option value=" . $i . ( $edit->sort == $i ? ' selected' : '' ) . ">" . $i . "</option>";
                        }?>
                    </select>
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