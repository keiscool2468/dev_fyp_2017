<!-- <?php $this->load->view('_partials/navbar'); ?> -->
<div class="container" style="width:50%">
	<div class="login-box">
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your barter</p>
			<?php echo $form->open(); ?>
				<?php echo $form->messages(); ?>
				<?php echo $form->bs3_text('Username', 'username', ENVIRONMENT==='development' ? '' : 'webmaster'); ?>
				<?php echo $form->bs3_password('Password', 'password', ENVIRONMENT==='development' ? '' : 'webmaster'); ?>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox">
							<label><input type="checkbox" name="remember"> Remember Me</label>
						</div>
					</div>
					<div class="col-xs-4">
						<?php echo $form->bs3_submit('Sign In', 'btn btn-primary btn-block btn-flat'); ?>
					</div>
				</div>
			<?php echo $form->close(); ?>
		</div>
	</div>
</div>
<?php $this->load->view('_partials/footer'); ?>
