
	<script type="text/javascript">
		function signup(){
			document.getElementById('withaccount').style.display = "none";
			document.getElementById('withoutaccount').style.display = "block";
			document.getElementById('newaccount').value = 'new';
		}
		
		function login(){
			document.getElementById('withaccount').style.display = "block";
			document.getElementById('withoutaccount').style.display = "none";
			document.getElementById('newaccount').value = 'old';
		}
	</script>
	
	<h1>Post a Project</h1>
	
	<p class="error">Note: All underlined fields are required.</p>
	<?php echo validation_errors('<div class="error">', '</div>'); ?>
	<div class="form">
		<h2>You</h2>
		<form method="POST">
			<p>Hi phpjobs,</p>
			<p>I work with <input class="form_post" type="text" name="profile[company]" value="company name"/>. We are currently looking for <input class="form_post" type="text" name="project[position]" value="job title"/> to work on a project called "<input class="form_post" type="text" name="project[name]" value="project name"/>".</p><p> This project (description) </p>
			<p><textarea name="project[description]" rows="10" cols="65"><?php echo set_value('project[description]'); ?></textarea></p>
			<p>Therefore, we are looking for individuals who possess the following technical skills and abilities: </p>
			<p><textarea name="project[qualifications]" rows="10" cols="65"><?php echo set_value('project[qualifications]'); ?></textarea></p>
			<p> Our budget allocated for this project is "<input class="form_post" type="text" name="project[compensation]" value="0.00"/>"(USD). We are <input class="form_post" type="checkbox" name="project[tbd]" <?php echo set_checkbox('project[tbd]'); ?>>open for negotation.</p>
			<p>Please <input class="form_post" type="checkbox" name="project[is_featured]" value=1 <?php echo set_checkbox('project[is_featured]',1); ?>>do include this in your featured list, <input class="form_post" type="checkbox" name="project[is_public]" <?php echo set_checkbox('project[is_public]'); ?>>do show this in public and <input class="form_post" type="checkbox" name="project[is_email_public]" <?php echo set_checkbox('project[is_email_public]'); ?>/>do show my email to public. Adding this job post to your distribution list will cost me an additional $1.00, please <input class="form_post" type="checkbox" name="project[for_distribution]" <?php echo set_checkbox('project[for_distribution]'); ?>>do include me in your distribution list.</p> 
			<p>
				<a href="javascript:void(0);" onclick="signup();">I don't have an account yet, so please sign me up.</a>
				<a href="javascript:void(0);" onclick="login();">Ooops, I almost forgot. I do have an account.</a>
			</p>
			<p id="withoutaccount" style="display:none;">Please sign me up to get this job post in your list and add my account with <input class="form_post" type="text" name="newusers[login]" value="username"> and my password is <input class="form_post" type="password" name="newusers[password]">. Again, my password is <input class="form_post" type="password" name="newusers[confirm_password]">. Please send your confirmation to this email address (<input class="form_post" type="text" name="profile[email]" value="email"/>).</p>
			<p id="withaccount">Please use this account <input class="form_post" type="text" name="users[login]" value="username"> and password (<input class="form_post" type="password" name="users[password]">) for this project post.</p>
			<p>By the way, I <input class="form_post" type="checkbox" id="i_agree"/>do agree to your Terms and Agreement and your privacy policy.</p>
			<br/>
			<p>Sincerely,</p>
			<p><input class="form_post" type="text" name="profile[firstname]" value="firstname"> <input class="form_post" type="text" name="profile[lastname]" value="lastname"></p>
			<input type="hidden" name="token" value="<?php echo $token?>">
			<input type="hidden" name="newaccount" value="new">
			<input type="submit" value="Send" name="action[submit]"> (Review the form before you send)
		</form>
	</div>

	