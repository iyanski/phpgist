	
	<h2>Featured Projects</h2>
	<div class="featured_projects">
		<?php if(!empty($featured)){?>
		<ul class="project_list">
			<?php foreach($featured as $project){?>
			<li class="project_list_item">
				<a href="<?php echo base_url()?>projects/item/<?php echo $project->id;?>">
					<div class="project_list_name"><?php echo $project->name;?></div>
				</a>
				<div class="project_list_company"><?php echo $project->company;?>&nbsp;</div>
				<div class="project_list_posted_date"><?php echo date("F m, Y", strtotime($project->created_on));?></div>
			</li>
			<?php }?>
		</ul>
		<?php }?>
	</div>
	<h2>Recent Projects</h2>
	<div class="recent_projects">
		<?php if(!empty($recent)){?>
		<ul class="project_list">
			<?php foreach($recent as $project){?>
			<li class="project_list_item">
				<a href="<?php echo base_url()?>projects/item/<?php echo $project->id;?>">
					<div class="project_list_name"><?php echo $project->name;?></div>
				</a>
				<div class="project_list_company"><?php echo $project->company;?>&nbsp;</div>
				<div class="project_list_posted_date"><?php echo date("F m, Y", strtotime($project->created_on));?></div>
			</li>
			<?php }?>
		</ul>
		<?php }?>
	</div>
