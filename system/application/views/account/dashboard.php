
	<h1>Dashboard</h1>
	<div id="dialog" title="Project Applicants"></div>
	<div id="project_editor" title="Edit Project" style="display:none;">
		<form id="editor" method="POST" action="<?php echo base_url()?>projects/save">
		<div class="form-row">
			<div class="form-label">
				<strong>Project name:</strong>
			</div>
			<input id="name" type="text" disabled="true"/>
			<input type="hidden" id="profile_id" name="projects[profile_id]" value="<?php echo $profile_id?>"/>
			<input type="hidden" id="project_id" name="projects[project_id]"/>
		</div>
		<div class="form-row">
			<div class="form-label">
				<strong>Position:</strong>
			</div>
			<input type="text" id="position" name="projects[position]"/>
		</div>
		<div class="form-row">
			<div class="form-label">
				<strong>Description:</strong>
			</div>
			<textarea id="description" name="projects[description]" rows="10" cols="65"></textarea>
		</div>
		<div class="form-row">
			<div class="form-label">
				<strong>Qualifications:</strong>
			</div>
			<textarea id="qualifications" name="projects[qualifications]" rows="10" cols="65"></textarea>
		</div>
		<div class="form-row">
			<div class="form-label">
				<strong>Contact Email:</strong>
			</div>
			<input type="text" id="email" name="projects[email]"/>
		</div>
		<div class="form-row">
			<div class="form-label">
				<strong>Compensation:</strong>
			</div>
			<input type="text" id="compensation" name="projects[compensation]"/> USD (TBD-to be discussed)
		</div>
	</div>
	
	<div class="account_dashboard">
		<div id="cover_letter_viewer"></div>
		<?php if(!empty($projects)){?>
		
		<div id="project_list">
		<ul class="list">
			<?php foreach($projects as $project){?>
			
			<li id="project_list_item_<?php echo $project->id;?>" class="project_list_item" item="<?php echo $project->id;?>" title="<?php echo $project->name;?>">
				<a class="project_list_link" href="javascript:void(0);" item="<?php echo $project->id;?>" title="<?php echo $project->name;?>">
					<div class="project_list_name"><?php echo $project->name;?></div>
				</a>
				<div class="project_list_company">&nbsp;</div>
				<div class="project_list_posted_date"><?php echo date("F m, Y", strtotime($project->created_on));?></div>
				<div class="project_list_actions" id="project_list_actions_<?php echo $project->id;?>">
					<img style="cursor:pointer" class="project_action_applicants" item="<?php echo $project->id;?>" src="<?php echo base_url()?>images/people.png" title="applicants" alt="applicants" width="20" height="20"/>
					<img style="cursor:pointer" class="project_action_edit" item="<?php echo $project->id;?>" src="<?php echo base_url()?>images/edit.png" title="edit" alt="edit" width="20" height="20"/>
					<img style="cursor:pointer" class="project_action_delete" item="<?php echo $project->id;?>" src="<?php echo base_url()?>images/trash.png" title="delete" alt="delete" width="20" height="20"/>
					<img class="ajax_loader" id="project_ajax_loader_<?php echo $project->id;?>" item="<?php echo $project->id;?>" src="<?php echo base_url()?>images/ajax-loader.gif" title="delete" alt="delete" width="20" height="20"/>
				</div>
			</li>
			<?php }?>
			
		</ul>
		</div>
		<?php }?>
		
	</div>
	<script type="text/javascript">
		$("a.project_list_link").click(function(){
			$.getJSON("<?php echo base_url()?>projects/get_project/" + $(this).attr("item"), function(data){
				if(data != ""){
					$("div#dialog").html("<h3>Description</h3><p>"+data.items.description+"</p><h3>Qualifications</h3>" + "<p>"+data.items.qualifications+"</p><p>Compensation: " + data.items.compensation + "</p>");
					$("#dialog").dialog({
						hide: 'slide',
						width: 500,
						height: 400,
						modal: true,
						title: $(this).attr("title")
					});
				}
			});
		});
		
		$("img.project_action_applicants").click(function(){
			$("project_ajax_loader_" + $(this).attr("item")).show();
			var contents = "";
			$.getJSON("<?php echo base_url()?>projects/get_applicants/" + $(this).attr("item"), function(data){
				contents += "<ul class='list'>";
				$.each(data.items, function(item,n){
					contents += "<li class='applicant_list_item'>";
					contents += "<div class='applicant_list_name'>" + data.items[item].firstname + " " + data.items[item].lastname + "</div>";
					contents += "<div class='applicant_list_posted_date'>" + data.items[item].created_on + "</div>";
					contents += "<div class='applicant_list_experience'>" + data.items[item].experience + "yr(s)</div>";
					contents += "<div class='applicant_list_actions'><a href='<?php echo base_url()?>account/application/" + data.items[item].id + "'>open</a></div>";
					contents += "</li>";
				});
				contents += "</ul>";
				
				if(data.items != "")
					$("div#dialog").html(contents);
				else
					$("div#dialog").html("There are not applicants to this project yet.");
					
				$("project_ajax_loader_" + $(this).attr("item")).hide();
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
			var item_id = $(this).attr("item");
			$.getJSON("<?php echo base_url()?>projects/edit/" + item_id, function(data){
				$("#project_id").val(data.items.id);
				$("#name").val(data.items.name);
				$("#position").val(data.items.position);
				$("#description").val(data.items.description);
				$("#qualifications").val(data.items.qualifications);
				$("#email").val(data.items.email);
				$("#compensation").val(data.items.compensation);
				$("#project_editor").dialog({
					hide: 'slide',
					width: 600,
					height: 500,
					modal: true,
					resizable: false,
					title: "Edit Project",
					buttons: {
						"Cancel": function(){
							$("#project_editor").dialog("close");
						},
						"Save": function(){
							$("#editor").submit();
						}
					}
				});
			});
		});
		
		$("img.project_action_delete").click(function(){
			var item_id = $(this).attr("item");
			$("div#dialog").html("Are you sure you want to delete this item?");
			$("#dialog").dialog({
				hide: 'slide',
				width: 400,
				modal: true,
				resizable: false,
				title: "Delete Project?",
				buttons: {
					"Cancel": function(){
						$("#dialog").dialog("close");
					},
					"Delete": function(){
						var delete_this = false;
						$.ajax({
							url: "<?php echo base_url()?>projects/destroy/" + item_id,
							type: "post",
							success: function(data){
								if(data == 1){
									$("#project_list_item_"+item_id).remove();
									$("#dialog").dialog('close');
								}
							}
						});
					}
				}
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
