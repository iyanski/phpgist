
	<h1>Get this Project (<?php echo $project->name;?>)</h1>
	<p><?php echo $project->url;?></p>
	<h3>Qualifications</h3>
	<p><?php echo $project->qualifications;?></p>
	<?php echo validation_errors(); ?>
	<div class="form">
		<h2>You</h2>
		<p>Note: All fields are required</p>
		<form method="POST">
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
			<?php echo form_error('profile[email]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Portfolio(URL): </strong>
				</div>
				<input type="text" name="profile[email]" value="<?php echo set_value('profile[email]'); ?>">
			</div>
			
			<h2>Resume</h2>
			<?php echo form_error('project[description]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Paste your Resume here: </strong>
				</div>
				<textarea name="project[description]" rows="30" cols="65"><?php echo set_value('project[description]'); ?></textarea>
			</div>
			<?php echo form_error('project[qualifications]'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Cover Letter: </strong>
				</div>
				<textarea name="project[qualifications]" rows="30" cols="65"><?php echo set_value('project[qualifications]'); ?></textarea>
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
				<input type="submit" value="Apply" name="action[submit]">
			</div>
		</form>
	</div>