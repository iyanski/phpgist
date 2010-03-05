	<?php $ci =& get_instance(); ?>
	<?php $session_user = (!empty($ci->session)) ? $ci->session->userdata('user') : false; ?>
	<div class="header">
		<div class="logo">
			<a href="<?php echo base_url()?>" title="phpgist">phpgist</a>
		</div>
		<div class="menu">
			<ul class="menu">
				<li class="item">
					<a href="<?php echo base_url()?>" title="Home">Home</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>projects" title="Projects">Projects</a>
				</li>
				<li class="item">
					<?php if(!$session_user){?>
					<a href="<?php echo base_url()?>home/login" title="Login">Login</a>
					<?php }else{?>
					<a href="<?php echo base_url()?>home/logout" title="Login">Logout</a>
					<?php }?>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/post" title="Post a Project">Post a Project</a>
				</li>
				<li class="item">
					<a href="<?php echo base_url()?>home/page/1" title="About phpgist">About</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="content">