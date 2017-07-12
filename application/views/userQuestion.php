<?php $this->load->view('_partials/navbar'); ?>
<?php defined('BASEPATH')OR exit('No direct script access allowed');?>
	<div class="container" >
		<div class="login-box">
			<form class="form-horizontal" role="form" action="register/comfirmInterest" method="post">
				<h1>What are you interested In ?</h1>
                <div class="checkbox">
					<?php foreach ($categorys as $category): ?>
						<input type="checkbox" name="<?php echo $category['id']; ?>" 
							value="<?php echo $category['id']; ?>"><?php echo $category['name_en']; ?><br>
					<?php endforeach; ?>
                </div>
				<br>
				<h2>Which one is more important for you?</h2>
				<table class="table">
					<tr>
						<th>Interest</th>
						<th></th>
						<th></th>
						<th></th>
						<th>Location</th>
					</tr>
					<tr>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
					</tr>
					<tr>
						<th><input type="radio" name="decision" value="20" checked></th>
						<th><input type="radio" name="decision" value="40"></th>
						<th><input type="radio" name="decision" value="50"></th>
						<th><input type="radio" name="decision" value="60"></th>
						<th><input type="radio" name="decision" value="80"></th>
					</tr>
				</table>
				<h2>Which one is more important for you?</h2>
				<select name="location_id" class="form-control">
					<?php foreach ($locations as $location): ?>
						<option value="<?php echo $location['id']; ?>">
							<?php echo $location['id']; ?>
							<?php echo $location['name_en']; ?>
						</option>
					<?php endforeach; ?>
				</select>
				<br>
				<button type="form_submit" class="btn btn-info">Submit</button>
			</form>
		</div>
	</div>
<style>
.checkbox {
	margin-left: 30px;
}
th, td {
	width: 20%;
    /*padding: 15px;*/
    text-align: center;
}
</style>
<script type="text/javascript">
    var sub = <?php echo json_encode($locations); ?>;
    console.log(sub);
</script>