
	<?php if(!empty($project)){?>
	<div style="padding-bottom: 20px;">
		<h1><?php echo $project->name;?></h1>
		<h2><?php echo $project->position;?></h2>
		<p><?php echo $project->description;?></p>
		<h3>Qualifications</h3>
		<p><?php echo $project->qualifications;?></p>
		<h3>Compensation</h3>
		<?php if(is_float($project->compensation)){?>
			<p>$<?php echo number_format($project->compensation,2);?> (USD)</p>
		<?php }else{?>
			<p><?php echo $project->compensation;?></p>
		<?php }?>
	</div>
	<div style="padding-top: 10px;">
		<a class="apply" href="<?php echo base_url()?>projects/apply/<?php echo $project->id;?>" title="<?php echo $project->name;?>" style="background-color: #CC9F6C; border: 1px solid #3d3d33; padding: 5px; width: 50px;">Apply</a>
	</div>
	<?php }else{?>
		<h1>Page Not Found</h1>
	<?php }?>
