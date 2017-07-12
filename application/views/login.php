<?php $this->load->view('_partials/navbar'); ?>
<?php defined('BASEPATH')OR exit('No direct script access allowed');?>
	<div class="container" >
		<div class="login-box col-sm-6">
			<form class="form-horizontal" role="form" action="login" method="post">
				<?php echo $form->messages(); ?>
				<label for="input_fish_name" class="control-label">E-mail</label>
				<input type="text" class="form-control" name="username" />
		
				<label for="input_fish_length" class="control-label">Password</label>
				<input type="password" class="form-control" name="password"/>
				</br>
				<div class="col-xs-8">
					<div class="checkbox">
						<label><input type="checkbox" name="remember"> Remember Me</label>
					</div>
				</div>
				<button type="form_submit" class="btn btn-info">Login</button>
				<button class="btn" disabled><a href="register" >Register</a></button>
			</form>
		</div>
	</div>