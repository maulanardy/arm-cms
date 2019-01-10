<?php 
if(Io::param('save')){

  foreach ($_POST["title"] as $key => $value) {

    $model = new \Ma\Model\Media\Main();

    $model->title = $_POST['title'][$key];
    $model->category_id = $_POST['category'][$key];
    $model->content = $_POST['content'][$key];
    $model->url = $_POST['url'][$key];
    $model->file = $_POST['file'][$key];
    $model->status = $_POST['status'][$key];

    $model->date_created = date('d-M-Y h:i:s');
    $model->date_publish = date('d-M-Y');
    
    $model->save();

  }

  echo "<script>window.location='index.php?menu=media_category'</script>";

	// if($ARM->media->save()){
 //        helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan</div>');
	// 	echo "<script>window.location='index.php?menu=media'</script>";
 //    }
}

?>

<form class="row" method="post" role="form" enctype="multipart/form-data">
    <div class="col-md-12">
      <div class="table-responsive">
        <h3 class="mastertitle">Save picture for <i>"<?php echo $_POST["cat_name"]?>"</i></h3>
        <input class="btn btn-sm btn-block btn-primary" type="submit" name="save" value="Save">
        <div class="formpicker-container">
          <table class="table">
            <tr>
              <th>Image</th>
              <th>Title</th>
              <th>URL</th>
              <th width="50%">Desc</th>
            </tr>
            <?php foreach ($_POST["file"] as $key => $value) { ?>

              <tr>
                <td><img src="<?php echo THUMBS."_100x100/".$value?>"></td>
                <td><input class="form-control" type="text" name="title[]" value="<?php echo  explode(".", end(explode("/", $value)))[0]?>"></td>
                <td><input class="form-control" type="text" name="url[]" value="#"></td>
                <td><textarea class="form-control" name="content[]" placeholder="Description.."></textarea></td>
              </tr>
              <input type="hidden" name="file[]" value="<?php echo $value?>">
              <input type="hidden" name="category[]" value="<?php echo $_POST["cat_id"]?>">
              <input type="hidden" name="status[]" value="1">
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
</form>