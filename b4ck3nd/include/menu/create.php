<?php 
if(Io::param('save')){
  if($ARM->menu->save())
    echo "<script>window.location='index.php?menu=menu'</script>";
}

$pages = $ARM->pages->retrieve();

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
                  <input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm" required>
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
                foreach ($data as $k => $v) {
                  $strip = "";
                  for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                  echo "<option value='" . $v->id . "'>" . $strip . $ARM->menu->Detail->getTitle($v->id, 1) . "</option>";

                  generateMenu($v->id, $ARM, $dash + 1);
                }
              }
              ?>
            </select>
            </div>

          <div class="form-group">
            <label>Navigation Type : <em>*</em></label>
            <select id="nav-type" name="link_to" class="form-control input-sm show-tick" data-live-search="true" required>
              <option value="direct"> Direct Link </option>
              <option value="page"> Static Page </option>
              <option value="category"> Post Category </option>
              <option value="media"> Media </option>
            </select>
          </div>


            <div class="form-group direct-option">
              <label>URL :</label>
              <input name="link_value" type="text" class="form-control input-sm">
            </div>
            <div class="form-group page-option">
            <label>Static Pages :</label>
            <select name="static_pages" class="form-control input-sm show-tick" data-live-search="true">
              <option value=""> - Select Page - </option>
              <?php foreach ($pages as $key => $value) { ?>
                <option value="<?php echo $value->id?>"><?php echo $ARM->pages->Detail->getTitle($value->id, 1);?></option>
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
                foreach ($data as $k => $v) {
                  $strip = "";
                  for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                  echo "<option value='" . $v->id . "'>" . $strip . $ARM->posts->Category->Detail->getTitle($v->id) . "</option>";

                  generateCategory($v->id, $ARM, $dash + 1);
                }
              }
              ?>
            </select>
            </div>
          <div class="form-group category-option">
            <label>Child Option:</label>

            <div class="radio">
              <input type="radio" name="child_option" id="child_option_1" value="no_child" checked>
              <label for="child_option_1">No Child</label>
            </div>
            <div class="radio">
              <input type="radio" name="child_option" id="child_option_2" value="category"> 
              <label for="child_option_2">Sub Category</label>
            </div>
            <div class="radio">
              <input type="radio" name="child_option" id="child_option_3" value="top_post">
              <label for="child_option_3">Highlighted post</label>
            </div>
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
          <label>Sort : <em>*</em></label>
          <select name="sort" class="form-control input-sm show-tick" data-live-search="true" required>
            <?php for ($i=1; $i <= 100 ; $i++) { 
              echo "<option value=" . $i . ">" . $i . "</option>";
            }?>
          </select>
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