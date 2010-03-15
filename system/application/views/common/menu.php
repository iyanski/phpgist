	<?php $ci =& get_instance(); ?>
	<?php $session_user = (!empty($ci->session)) ? $ci->session->userdata('user') : false; ?>
	<div class="header">
		<div class="logo">
			<a href="<?php echo base_url()?>" title="phpgist">phpgist</a>
			<div style="font-size: 12px; color: #FFF;">PHP Projects for PHP Developers</div>
		</div>
		
		<div class="menu">
			<ul class="menu">
				<li class="item">
					<a href="<?php echo base_url()?>" title="Home">Home</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>projects" title="Projects">Projects</a>
				</li>
				<?php if(!$session_user){?>
				<li class="item">
					<a href="<?php echo base_url()?>home/signup" title="Signup">Signup</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/login" title="Login">Login</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/post" title="Post a Project">Post a Project</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/page/1" title="About phpgist">About</a>
				</li>
				<?php }else{?>
				<li class="item">
					<a href="<?php echo base_url()?>account/dashboard" title="Account">Account</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/post" title="Post a Project">Post a Project</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/page/1" title="About phpgist">About</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/logout" title="Login">Logout</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</div>
	<div class="content">