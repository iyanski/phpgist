
	<style>
		input{
			padding: 3px;
			font-size: 14px;
		}
	</style>
	<h1>Signup</h1>
	<?php echo validation_errors(); ?>
	<div class="form">
		<h2>You</h2>
		<form method="POST">
			<?php echo form_error('users[login]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Username:</strong>
				</div>
				<input type="text" name="users[login]" value="<?php echo set_value('users[login]'); ?>">
			</div>
			<?php echo form_error('users[password]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Password:</strong> 
				</div>
				<input type="password" name="users[password]" value="">
			</div>
			<?php echo form_error('users[confirm_password]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Retype Password:</strong>
				</div>
				<input type="password" name="users[confirm_password]" value="">
			</div>
			<p>&nbsp;</p>
			<?php echo form_error('profile[firstname]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>First Name:</strong>
				</div>
				<input type="text" name="profile[firstname]" value="<?php echo set_value('profile[firstname]'); ?>">
			</div>
			<?php echo form_error('profile[lastname]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Last Name: </strong>
				</div>
				<input type="text" name="profile[lastname]" value="<?php echo set_value('profile[lastname]'); ?>">
			</div>
			<?php echo form_error('profile[email]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Email: </strong>
				</div>
				<input type="text" name="profile[email]" value="<?php echo set_value('profile[email]'); ?>">
			</div>
			<div class="form-row">
				<div class="form-label">
					&nbsp; 
				</div>
				<input type="hidden" name="token" value="<?php echo $token?>">
				<input type="submit" value="Post" name="action[submit]">
			</div>
		</form>
	</div>