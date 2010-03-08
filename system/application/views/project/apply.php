
	<h1>Get this Project (<?php echo $project->name;?>)</h1>
	<p><?php echo $project->url;?></p>
	<h3>Qualifications</h3>
	<p><?php echo $project->qualifications;?></p>

	<div class="form">
		<h2>You</h2>
		<p>Note: All fields are required</p>
		<form method="POST">
			<?php echo form_error('applicant[firstname]','<div class="error">', '</div>'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>First Name:</strong>
				</div>
				<input type="text" name="applicant[firstname]" value="<?php echo set_value('applicant[firstname]'); ?>">
			</div>
			<?php echo form_error('applicant[lastname]','<div class="error">', '</div>'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Last Name: </strong>
				</div>
				<input type="text" name="applicant[lastname]" value="<?php echo set_value('applicant[lastname]'); ?>">
			</div>
			<?php echo form_error('applicant[email]','<div class="error">', '</div>');?>
			<div class="form-row">
				<div class="form-label">
					<strong>Email: </strong>
				</div>
				<input type="text" name="applicant[email]" value="<?php echo set_value('applicant[email]'); ?>">
			</div>
			<?php echo form_error('applicant[portfolio]','<div class="error">', '</div>'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Portfolio(URL): </strong>
				</div>
				<input type="text" name="applicant[url]" value="<?php echo set_value('applicant[url]'); ?>">
			</div>
			
			<h2>Resume</h2>
			<?php echo form_error('applicant[resume]','<div class="error">', '</div>'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Paste your Resume here: </strong>
				</div>
				<textarea name="applicant[resume]" rows="30" cols="65"><?php echo set_value('applicant[resume]'); ?></textarea>
			</div>
			<?php echo form_error('applicant[coverletter]','<div class="error">', '</div>'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Cover Letter: </strong>
				</div>
				<textarea name="applicant[coverletter]" rows="30" cols="65"><?php echo set_value('applicant[coverletter]'); ?></textarea>
			</div>
			<?php echo form_error('applicant[experience]','<div class="error">', '</div>'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Years of Experience: </strong>
				</div>
				<input type="text" name="applicant[experience]" value="<?php echo set_value('applicant[experience]'); ?>"/>
			</div>
			<br/>
			<?php echo form_error('i_agree','<div class="error">', '</div>'); ?>
			<div class="form-row">
				<div class="form-label">
					<strong>Agree to our Terms? </strong>
				</div>
				<input type="checkbox" id="i_agree" name="i_agree">
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