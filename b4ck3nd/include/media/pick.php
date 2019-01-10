<?php

if(!isset($_GET["cat"])){
	header("Location: index.php?menu=media_category");
}

$category = $_GET["cat"];

$data = $ARM->mediaCategory->getBySlug($category);

?>

<div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  		<h3 class="mastertitle">Select picture for <i>"<?php echo $data->title?>"</i></h3>
			
			<form method="post" role="form" id="formNext" action="<?php echo BASE.BACKEND?>/index.php?menu=media&action=create">
				<p class="clearfix">
					<a href="<?php echo BASE.BACKEND?>/index.php?menu=media&cat=<?php echo $data->slug?>" class="btn btn-sm btn-danger"> << Back</a>
				</p>
				<div class="col-md-9">
					<div class="picker-container">
						<div class="filetree-basic"></div>
					</div>
				</div>

		    <div class="col-md-3">
		    <div class="form_selected_file">
		    </div>

		    <input type="hidden" name="cat_id" value="<?php echo $data->id?>">
		    <input type="hidden" name="cat_name" value="<?php echo $data->title?>">
		    <input type="hidden" name="cat_clug" value="<?php echo $data->slug?>">
				<input class="btn btn-sm btn-block btn-primary" id="next" type="submit" name="next" value="Next">

				<hr>

		     <div class="panel panel-default" style="height: 400px;overflow: scroll;">
					<div class="panel-heading">
	          <div class="panel-title"><i class="fa fa-gear"></i> Selected Image</div>
	        </div>

					<div class="panel-body">
						<ul class="selected-image">
							
						</ul>
	        </div>
		    </div>
			</form>
		</div>
	</div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	$(document).ready(function() {

		$('.filetree-basic').fileTree({ 
			root: '/' ,
			script: '<?php echo BASE.BACKEND?>/jQueryFileTree.php',
 			expandEasing: 'easeOutBounce',
 			multiSelect: true
		}, function(file) {
			$el = $( ".filetree-basic input:checked" );

			var checked = $el
					.map(function() {
						if($(this).parent().hasClass("file")){
							return "<li>" + $(this).parent().find('a:first').text() + "</li>";
						}
					})
					.get()
					.join("");

			var form = $el
					.map(function() {
						if($(this).parent().hasClass("file")){
							return "<input type='hidden' name='file[]' value='" + $(this).parent().find('a:first').attr("rel") + "'>";
						}
					})
					.get()
					.join("");

			$(".selected-image").html(checked);
			$(".form_selected_file").html(form);
		});

		$('#next').on('click', function(e){
			e.preventDefault();

			$el = $( ".filetree-basic input:checked" );

			var checked = $el
					.map(function() {
						if($(this).parent().hasClass("file")){
							return "<li>" + $(this).parent().find('a:first').text() + "</li>";
						}
					})
					.get()
					.join("");

			var form = $el
					.map(function() {
						if($(this).parent().hasClass("file")){
							return "<input type='hidden' name='file[]' value='" + $(this).parent().find('a:first').attr("rel") + "'>";
						}
					})
					.get()
					.join("");

			if(checked == ""){
				alert("Please select at least 1 picture");
			} else {

				$(".selected-image").html(checked);
				$(".form_selected_file").html(form);
				$("#formNext").submit();
			}
		})

	});
</script>