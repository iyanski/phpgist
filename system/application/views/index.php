		
		<div class="home">
			<h1>PHP Freelance Projects</h1>
			<p class="banner">PHPgist is a targeted destination for php freelancers. We have a list of php freelance web projects from all over the world. Start looking for PHP projects from our directory. <a href="<?php echo base_url()?>projects" title="Browse phpgist project directory">Browse Here</a>. Free unlimited posting for a limited time. <a href="<?php echo base_url()?>home/post" title="Post Projects to phpgist">Post Now</a></p>
			<h2>Serious Posts</h2>
			<div class="featured_projects">
				<?php if(!empty($featured)){?>
				
				<ul class="project_list">
					<?php foreach($featured as $project){?>
					
					<li class="project_list_item">
						<a href="<?php echo base_url()?>projects/item/<?php echo $project->id;?>" title="<?php echo $project->name;?>">
							<div class="project_list_name"><?php echo $project->name;?></div>
						</a>
						<div class="project_list_company"><?php echo $project->company;?>&nbsp;</div>
						<div class="project_list_posted_date"><?php echo date("F m, Y", strtotime($project->created_on));?></div>
					</li>
					<?php }?>
					
				</ul>
				<?php }?>
				
			</div>
		</div>
		
