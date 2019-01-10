<?php 
$event = new Event\Main();
$eventCategory = new Event\Category();

if(Io::param('save')){
    if(empty(Io::param("title_id"))){

        helper::flashdata('regStatus','<div class="alert alert-danger" role="alert">Judul tidak boleh kosong</div>');

    } else if(empty(Io::param("published"))){

        helper::flashdata('regStatus','<div class="alert alert-danger" role="alert">Anda harus memilih tanggal publish</div>');

    } else if(empty(Io::param("category"))){

        helper::flashdata('regStatus','<div class="alert alert-danger" role="alert">Anda harus memilih kategori</div>');

    } else {
        if($event->save()){
            helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan</div>');
            echo "<script>window.location='index.php?menu=Event'</script>";
        }
    }
}

$language = $ARM->language->retrieve();

$category = $eventCategory->getActive();
?>
<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-9">
        <?php echo helper::flashdata('regStatus');?>
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">Event Form</div>
                </div>

                <div class="panel-body">

                    <div class="form-group">
                        <label>Category : <em>*</em></label>
                        <select name="category" class="form-control input-sm show-tick" data-live-search="true" required>
                            <option> - Select Category</option>

                            <?php
                            generateMenu(0, $eventCategory, $dash = 0);

                            function generateMenu($parent = 0, $controller, $dash){
                                $conditions['parent'] = $parent;
                                $conditions['status'] = 1;

                                $data = $controller->model->find('all', array( 'conditions' => $conditions, 'order' => 'id asc'));

                                if($data){
                                    buildMenu($data, $controller, $dash);
                                }
                            }

                            function buildMenu($data, $controller, $dash)
                            {
                                foreach ($data as $k => $v) {
                                    $strip = "";
                                    for ($i=0; $i < $dash; $i++){ $strip .= " - - ";}

                                    echo "<option value='" . $v->id . "'>" . $strip . $controller->Detail->getTitle($v->id, 1) . "</option>";

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
                        <label>Contact Detail : <em>*</em></label>
                        <textarea name="contact" id="contact" class="form-control input-sm texteditor"></textarea>
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

        <hr>

        <div class="panel panel-default">
                <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-gear"></i> Attribute</div>
            </div>

                <div class="panel-body">

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
                    <label>Event Organizer : </label>
                    <input name="event_organizer" value="" type="text" class="form-control input-sm">
                </div>

                <div class="form-group">
                    <label>Ticket Price : </label>
                    <input name="ticket_price" value="" type="text" class="form-control input-sm">
                </div>

                <div class="form-group">
                    <label>Venue & Location : </label>
                    <input name="location" value="" type="text" class="form-control input-sm">
                </div>

                <div class="form-group">
                    <label>Maps Widget : </label>
                    <textarea name="ticket_maps_widget" id="ticket_maps_widget" class="form-control input-sm"></textarea>
                </div>

                <div class="form-group">
                    <label>Ticket URL : </label>
                    <input name="ticket_url" value="" type="text" class="form-control input-sm">
                </div>

                <div class="form-group">
                    <label>Start Date :</label>
                    <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                        <input name="start_date" type="text" class="form-control input-sm" value="<?php echo date("Y-m-d")?>">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>End Date :</label>
                    <div class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                        <input name="end_date" type="text" class="form-control input-sm" value="<?php echo date("Y-m-d")?>">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Time : </label>
                    <input name="event_time" value="" type="text" class="form-control input-sm">
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