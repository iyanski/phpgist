
	<h1>Dashboard</h1>
	<div id="dialog" title="Project Applicants">
		
	</div>
	<div class="account_dashboard">
		<?php if(!empty($projects)){?>
		
		<ul class="list">
			<?php foreach($projects as $project){?>
			
			<li class="project_list_item" item="<?php echo $project->id;?>" title="<?php echo $project->name;?>">
				<a class="project_list_link" href="javascript:void(0);" item="<?php echo $project->id;?>" title="<?php echo $project->name;?>">
					<div class="project_list_name"><?php echo $project->name;?></div>
				</a>
				<div class="project_list_company">&nbsp;</div>
				<div class="project_list_posted_date"><?php echo date("F m, Y", strtotime($project->created_on));?></div>
				<div class="project_list_actions" id="project_list_actions_<?php echo $project->id;?>">
					<img class="project_action_applicants" item="<?php echo $project->id;?>" src="<?php echo base_url()?>images/people.png" title="applicants" alt="applicants" width="20" height="20"/>
					<img class="project_action_edit" item="<?php echo $project->id;?>" src="<?php echo base_url()?>images/edit.png" title="edit" alt="edit" width="20" height="20"/>
					<img class="project_action_delete" item="<?php echo $project->id;?>" src="<?php echo base_url()?>images/trash.png" title="delete" alt="delete" width="20" height="20"/>
				</div>
			</li>
			<?php }?>
			
		</ul>
		<?php }?>
		
	</div>
	<script type="text/javascript">
		$("a.project_list_link").click(function(){
			$.getJSON("<?php echo base_url()?>projects/get_project/" + $(this).attr("item"), function(data){
				$.each(data.items, function(item,n){
					$("div#dialog").html("<h3>Description</h3><p>"+data.items[item].description+"</p><h3>Qualifications</h3>" + "<p>"+data.items[item].qualifications+"</p><p>Compensation: " + data.items[item].compensation + "</p>");
				});
				$("#dialog").dialog({
					hide: 'slide',
					width: 500,
					modal: true,
					title: $(this).attr("title")
				});
			});
		});
		
		$("img.project_action_applicants").click(function(){
			var contents = "";
			$.getJSON("<?php echo base_url()?>projects/get_applicants/" + $(this).attr("item"), function(data){
				contents += "<ul class='list'>";
				$.each(data.items, function(item,n){
					contents += "<li class='applicant_list_item'>";
					contents += "<div class='applicant_list_name'>" + data.items[item].firstname + " " + data.items[item].lastname + "</div>";
					contents += "<div class='applicant_list_posted_date'>" + data.items[item].created_on + "</div>";
					contents += "<div class='applicant_list_actions'>open</div>";
					contents += "</li>";
				});
				contents += "</ul>";
				$("div#dialog").html(contents);
				$("#dialog").dialog({
					hide: 'slide',
					width: 500,
					height: 400,
					modal: true,
					title: "Project Applicants"
				});
			});
		});
		
		$("img.project_action_edit").click(function(){
			$("#dialog").dialog({
				hide: 'slide',
				width: 500,
				height: 400,
				modal: true,
				resizable: false,
				title: "Edit Project",
			});
		});
		
		$("img.project_action_delete").click(function(){
			$("div#dialog").html("Are you sure you want to delete this item?");
			$("#dialog").dialog({
				hide: 'slide',
				width: 500,
				modal: true,
				resizable: false,
				title: "Delete Project?",
				buttons: {
					"Cancel": function(){
						$("#dialog").dialog("close");
					},
					"Delete": function(){
						
					}
				}
			});
		});
		
		$("img.project_action_edit").click(function(){
			$("#dialog").dialog({
				hide: 'slide',
				width: 500,
				height: 400,
				modal: true,
				title: "Delete Project"
			});
		});
		
		$(".project_list_item").hover(
			function(){
				$("#project_list_actions_" + $(this).attr("item")).show();
			},
			function(){
				$("#project_list_actions_" + $(this).attr("item")).hide();
			}
		);
	</script>
