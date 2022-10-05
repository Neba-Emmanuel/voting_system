<?php include 'db_connect.php' ?>
<?php
	session_start();
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
 include('./header.php'); 
 // include('./auth.php'); 
 ?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form action="" id="manage-opt">
			<input type="hidden" name="voting_id" value="<?php echo $_GET['vid'] ?>">
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
			<div class="form-group">
				<label for="" class="control-label">Image</label>
				<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
			</div>
			<div class="form-group">
				<img src="<?php echo isset($image_path) ? 'assets/img/'.$image_path :'' ?>" alt="" id="cimg">
			</div>
		</form>
	</div>
</div>

<style>
	img#cimg{
		max-height: 10vh;
		max-width: 6vw;
	}
</style>
<script>
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('#manage-opt').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_opt',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.','success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else if(resp == 2){
					alert_toast('Data successfully updated.','success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})

	})
</script>