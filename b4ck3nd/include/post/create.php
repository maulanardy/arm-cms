<?php 
if(Io::param('save')){
    if(empty(Io::param("title_id"))){

        helper::flashdata('regStatus','<div class="alert alert-danger" role="alert">Judul tidak boleh kosong</div>');

    } else if(empty(Io::param("published"))){

        helper::flashdata('regStatus','<div class="alert alert-danger" role="alert">Anda harus memilih tanggal publish</div>');

    } else if(empty(Io::param("category"))){

        helper::flashdata('regStatus','<div class="alert alert-danger" role="alert">Anda harus memilih kategori</div>');

    } else {
        if($ARM->posts->save()){
            helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan</div>');
            echo "<script>window.location='index.php?menu=post'</script>";
        }
    }
}
if(Io::param('saveonly')){
    if(empty(Io::param("title_id"))){

        helper::flashdata('regStatus','<div class="alert alert-danger" role="alert">Judul tidak boleh kosong</div>');

    } else {
        if($ARM->posts->saveOnly()){
            echo "<script>window.location='index.php?menu=post&action=edit&id=".$ARM->posts->updated_id."'</script>";
        }
    }
}

$language = $ARM->language->retrieve();

$category = $ARM->postsCategory->retrieve();
$gallery = $ARM->mediaCategory->retrieve();


$hashtag = new \Ma\Model\Posts\Hashtag();
$query = $hashtag->find("all", array("order" => "name asc")); 

foreach ($query as $key => $value) {
  $hashtag_arr[] = '"'.$value->name.'"';
}
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <?php echo helper::flashdata('regStatus');?>
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">Post Form</div>
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        <label>Category : <em>*</em></label>
                        <select name="category" class="form-control input-sm show-tick" data-live-search="true" required>
                            <option> - Select Category</option>

                            <?php
                            generateMenu(0, $ARM, $dash = 0);

                            function generateMenu($parent = 0, $ARM, $dash){
                                $conditions['parent'] = $parent;
                                $conditions['status'] = 1;

                                $data = $ARM->postsCategory->model->find('all', array( 'conditions' => $conditions, 'order' => 'title asc'));

                                if($data){
                                    buildMenu($data, $ARM, $dash);
                                }
                            }

                            function buildMenu($data, $ARM, $dash)
                            {
                                foreach ($data as $k => $v) {
                                    $strip = "";
                                    for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                                    echo "<option value='" . $v->id . "'>" . $strip . $ARM->posts->Category->Detail->getTitle($v->id, 1) . "</option>";

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
                                        <label>Title (<?php echo $value->nama?>):</label>
                                        <input name="title_<?php echo $value->kode?>" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group">
                                        <label>Content (<?php echo $value->nama?>):</label>
                                        <textarea name="content_<?php echo $value->kode?>" id="content_<?php echo $value->kode?>" class="form-control input-sm texteditor"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Summary (<?php echo $value->nama?>):</label>
                                        <textarea name="excerpt_<?php echo $value->kode?>" id="excerpt_<?php echo $value->kode?>" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>

                            <?php }?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tags : <em>*</em></label>
                        <input type="text" name="tags" id="input-tags" class="form-control" value="">
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-3">
        <input class="btn btn-sm btn-block btn-success" type="submit" name="save" value="Save & Publish">
        <input class="btn btn-sm btn-block btn-default" type="submit" name="saveonly" value="Save">

        <hr>

        <div class="panel panel-default">
                <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-gear"></i> Attribute</div>
            </div>

                <div class="panel-body">
                <script type="text/javascript">
                  var hashtagSource = [<?php echo implode (",", $hashtag_arr);?>];
                </script>
                <div class="form-group">
                    <label>HashTag : <em>*</em></label>
                    <div class="input-group">
                      <div class="input-group-addon">#</div>
                      <input type="text" name="hashtag" id="hashtag" class="form-control" value="">
                    </div>
                </div>


                <div class="form-group">

                    <label>Position : <em>*</em></label>
                    <?php
                    $data = \Ma\Model\Posts\Position::find('all', array( 'conditions' => array('status = 1'), 'order' => 'title asc'));

                    foreach ($data as $k => $v) {
                        echo "<div class='checkbox checkbox-success'>";
                        echo "<input id='checkbox_$v->id' type='checkbox' name='position[]' value='$v->id'>";
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
                        <option value="default">Post Default</option>
                        <option value="gallery">Gallery Album</option>
                        <option value="video">Video Player</option>
                        <option value="youtube">Youtube Player</option>
                        <option value="registration">Post Registration</option>
                        <option value="document">Download Page</option>
                    </select>
                </div>

                <div class="form-group">
                    <img id="file-preview" src="<?php echo BASE?>images/no-image.png" style="width:100%">
                </div>

                <div class="form-group">
                    <label>Cover Post : </label>
                    <div class="input-group">
                        <input name="file" value="" type="text" id="file" data-preview="file-preview" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=file&type=1&relative_url=1"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>

                <div class="form-group">
                    <label>Media Caption :</label>
                    <input name="media_caption" type="text" class="form-control input-sm">
                </div>

                <div class="form-group video-option">
                    <label>Video File :</label>
                    <div class="input-group">
                        <input name="video" type="text" id="video" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=video&type=3&relative_url=1"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>

                <div class="form-group document-option">
                    <label>Document :</label>
                    <div class="input-group">
                        <input name="document" type="text" id="document" class="form-control input-sm">
                        <a class="input-group-addon fancy-iframe" href="<?php echo BASE.BACKEND?>/style/js/filemanager/dialog.php?field_id=document&relative_url=1"><i class="fa fa-file"></i></a>
                    </div>
                </div>

                <div class="form-group gallery-option">
                    <label>Gallery : <em>*</em></label>
                    <select name="gallery" class="form-control input-sm show-tick" data-live-search="true">
                        <option> - Select Gallery</option>
                        <?php foreach ($gallery as $v) { ?>
                            <option value="<?php echo $v->id?>"><?php echo $v->title?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="form-group youtube-option">
                    <label>Youtube URL :</label>
                    <input name="youtube" type="text" id="youtube" class="form-control input-sm">
                </div>

                <div class="form-group">
                    <label>Publish Date :</label>
                    <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                        <input name="published" type="text" class="form-control input-sm" value="<?php echo date("Y-m-d")?>">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Unpublish Date :</label>
                    <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                        <input name="unpublished" type="text" class="form-control input-sm">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Featured :</label>
                    <div class="checkbox checkbox-primary">
                        <input id="featured" name="featured" type="checkbox" value="1">
                        <label for="featured"> Featured Content </label>
                    </div>
                    <div class="checkbox checkbox-primary">
                        <input id="highlight" name="highlight" type="checkbox" value="1">
                        <label for="highlight"> Highlight on Menu </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status : <em>*</em></label>
                    <div class="radio radio-success">
                        <input name="status" type="radio" id="radio-enable"  value="1" checked>
                        <label for="radio-enable"> Enable </label>
                    </div>
                    <div class="radio radio-danger">
                        <input name="status" type="radio" id="radio-disable" value="0">
                        <label for="radio-disable"> Disable </label>
                    </div>
                </div>
                </div>
        </div>
    </div>
</form>