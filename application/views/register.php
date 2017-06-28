<?php $this->load->view('_partials/navbar'); ?>
<?php defined('BASEPATH')OR exit('No direct script access allowed');?>
	<div class="container" >
		<div class="login-box col-sm-6">
			<form class="form-horizontal" role="form" action="register" method="post">
				<?php echo $form->messages(); ?>
				<label class="control-label">Username</label>
				<input type="text" class="form-control" name="username" />

				<label class="control-label">Password</label>
				<input type="password" class="form-control" name="password"/>

                <?php echo $form->bs3_password('Retype Password', 'retype_password'); ?>
				<label class="control-label">E-mail</label>
				<input type="text" class="form-control" name="email" />
		
				<label class="control-label">First Name</label>
				<input type="password" class="form-control" name="first_name"/>

				<label class="control-label">Last Name</label>
				<input type="text" class="form-control" name="last_name" />
                <div class="col-sm-6">
                    <label class="control-label">Phone Number</label>
                    <input type="password" class="form-control" name="phone"/>    
                </div>
                <div class="col-sm-6"> 
                    <label class="control-label">Company(Optional)</label>
                    <input type="text" class="form-control" name="company" />
                </div>
				<button type="form_submit" class="btn btn-info">Create Account</button>
			</form>
		</div>
	</div>
<?php $this->load->view('_partials/footer'); ?>