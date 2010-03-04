
	<h1>Edit this Project</h1>
	<?php echo validation_errors(); ?>
	<div class="form">
		<h2>You</h2>
		<form method="POST">
		<?php if(!empty($user)){ ?>
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
		<?php }else{ ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Username:</strong>
				</div>
				<?php echo $user['login']; ?>asdf
			</div>
			<div class="form-row">
				<div class="form-label">
					<strong>First Name:</strong>
				</div>
				<?php echo $user['firstname']; ?>
			</div>
			<div class="form-row">
				<div class="form-label">
					<strong>Last Name: </strong>
				</div>
				<?php echo $user['lastname']; ?>
			</div>
			<div class="form-row">
				<div class="form-label">
					<strong>Email: </strong>
				</div>
				<?php echo $user['email']; ?>
			</div>
		<?php }?>
			<div class="form-row">
				<div class="form-label">
					Confidentiality: 
				</div>
				<input type="checkbox" name="profile[is_confidential]" value="<?php echo set_value('profile[is_confidential]'); ?>">
				Display Name as "Confidential"
			</div>

			<h2>Job</h2>
			<?php echo form_error('project[name]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Name: </strong>
				</div>
				<input type="text" name="project[name]" value="<?php echo set_value('project[name]'); ?>">
			</div>
			<?php echo form_error('project[description]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Description: </strong>
				</div>
				<textarea name="project[description]" rows="10" cols="65"><?php echo set_value('project[description]'); ?></textarea>
			</div>
			<?php echo form_error('project[qualifications]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Qualifications: </strong>
				</div>
				<textarea name="project[qualifications]" rows="10" cols="65"><?php echo set_value('project[qualifications]'); ?></textarea>
			</div>
			<?php echo form_error('project[position]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Job Title: </strong>
				</div>
				<input type="text" name="project[position]" value="<?php echo set_value('project[position]'); ?>">
			</div>
			<?php echo form_error('project[compensation]'); ?>
			<div class="form-row">
				<div class="form-label">
					Compensation:
				</div>
				<input type="text" name="project[compensation]" value="<?php echo set_value('project[compensation]'); ?>">
				(USD)
				<input type="checkbox" name="project[tbd]" <?php echo set_checkbox('project[tbd]'); ?>> TBD
			</div>
			<div class="form-row">
				<div class="form-label">
					Featured? 
				</div>
				<input type="checkbox" name="project[is_featured]" value=1 <?php echo set_checkbox('project[is_featured]',1); ?>>
			</div>
			<div class="form-row">
				<div class="form-label">
					Show to public?
				</div>
				<input type="checkbox" name="project[is_public]" <?php echo set_checkbox('project[is_public]'); ?>>
			</div>
			<div class="form-row">
				<div class="form-label">
					Show email to public?
				</div>
				<input type="checkbox" name="project[is_email_public]" <?php echo set_checkbox('project[is_email_public]'); ?>>
			</div>
			<div class="form-row">
				<div class="form-label">
					Distribute?
				</div>
				<input type="checkbox" name="project[for_distribution]" <?php echo set_checkbox('project[for_distribution]'); ?>>
			</div>
			<br/>
			<div class="form-row">
				<div class="form-label">
					<strong>Agree to our Terms? </strong>
				</div>
				<input type="checkbox" id="i_agree">
				Terms of agreement | Privacy Policy
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