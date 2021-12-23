<a class='back' href='/'>< Back</a>
<?php echo form_open('users/login'); ?>
<fieldset>
    <legend><?php echo $title; ?></legend> 
	<div class="form-group">
	  	<input type="text" name="username" class="form-control mt-2" placeholder="Enter Username" required autofocus>
		<small id="emailHelp" class="form-text text-muted">username: administrator</small>
	</div>
	<div class="form-group">
		<input type="password" name="password" class="form-control mt-2" placeholder="Enter Password" required>
		<small id="emailHelp" class="form-text text-muted">password: password</small>
    </div>
	<button type="submit" class="btn btn-primary mt-2">Login</button>
</fieldset>
<?php echo form_close(); ?>