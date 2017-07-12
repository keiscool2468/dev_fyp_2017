<?php $this->load->view('_partials/navbar'); ?>
<?php defined('BASEPATH')OR exit('No direct script access allowed');?>
	<div class="container" >
		<div class="login-box">
			<form class="form-horizontal" role="form" action="transaction/feedback" method="post">
				<?php if($boolean){ ?>
                    <h1>What's make you complete this barter?</h1>
                    <div class="checkbox">
                        <input type="checkbox" name="location" 
                                value="location">Location is Good<br>
                        <input type="checkbox" name="category" 
                                value="category">I like This thing
                    </div>
                <?php }else{ ?>
                    <h1>What's make you decline this barter?</h1>
                    <div class="checkbox">
                        <input type="checkbox" name="location" 
                                value="location">Location is not acceptable<br>
                        <input type="checkbox" name="category" 
                                value="category">I dont like This thing
                    </div>
                <?php } ?>
				<button type="form_submit" class="btn btn-info">Submit</button>
                <h1>Thanks for your feedback!!</h1>
			</form>
		</div>
	</div>

<style>
.checkbox {
	margin-left: 20px;
}
button,
span {
    margin-top: 10%;
}
</style>