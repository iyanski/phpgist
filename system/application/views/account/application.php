
	<h1>Applicant for <?php echo $applicant->name?> (<?php echo $applicant->lastname . ", " .$applicant->firstname?>)</h1>
	<div id="dialog" title="<?php echo $applicant->firstname . " " . $applicant->lastname?>'s Resume"></div>
	<div class="information">
		<a href="<?php echo base_url()?>account/dashboard">Back to list</a> | <a href="javascript:void(0);" class="view_resume" item="<?php echo $applicant->id?>">View Resume</a>
		<p><?php echo $applicant->coverletter?></p>
	</div>
	<script type="text/javascript">
		$("a.view_resume").click(function(){
			$.getJSON("<?php echo base_url()?>account/resume/" + $(this).attr("item"), function(data){
				if(data != ""){
					console.log(data.items);
					$("div#dialog").html("<p>"+data.items.resume+"</p><p>Email: "+data.items.email+"</p>");
					$("#dialog").dialog({
						hide: 'slide',
						width: 700,
						height: 500,
						modal: true,
						title: $(this).attr("title")
					});
				}
			});
		});
	</script>