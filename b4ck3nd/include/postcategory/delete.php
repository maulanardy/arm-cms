<?php
if(Io::param('delete')){
	$data = $ARM->postsCategory->delete(Io::param('id'));
	if($data){
    helper::flashdata('regStatus','<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
		echo "<script>window.location='index.php?menu=postcategory'</script>";
	}
}
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">Deleting item(s)</h3>
  </div>
  <div class="panel-body">
    Are you sure want to delete? 
    <form action="" method="POST">
    <a href="<?php echo BASE.BACKEND?>/index.php?menu=postcategory" class="btn btn-default">Cancel</a>
    <input type="hidden" name="id" value="<?php echo Io::param('id')?>">
    <input type="submit" name="delete" value="delete" class="btn btn-danger">
    </form>
  </div>
</div>