<?php include '../doc/header.php'; ?>

<?php
require ('../config/db.php');
// session_start();
?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>

<style>
fieldset {
	border: 1px solid #ddd !important;
	margin: 0;
	xmin-width: 0;
	padding: 10px;
	position: relative;
	border-radius: 4px;
	background-color: #f5f5f5;
	padding-left: 10px !important;
}

legend {
	font-size: 14px;
	font-weight: bold;
	margin-bottom: 0px;
	width: 20%;
	border: 1px solid #ddd;
	border-radius: 4px;
	padding: 5px 5px 5px 10px;
	background-color: #ffffff;
}

p {
	font-size: 0.80rem;
}

body {
	margin: 10px;
}

.btn-danger {
	background: red;
}

.editField {
	margin-top: 10px;
}
</style>

<?php

// storing request (ie, get/post) global array to a variable
$requestData = $_REQUEST;

$id = $_GET['id'];

$query = "select * from tasks where id ='$id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

$st_id = $row["stations_id"];
$status = $row["status"];
$maint_date=$row["start_date"];
$task_name=$row["name"];

$query_st = "select * from stations where station_id ='$st_id'";
$result_st = mysqli_query($con, $query_st) or die(mysqli_error($con));
$row_st = mysqli_fetch_assoc($result_st);

?>

<div>
	<button class="btn btn-outline-info btn-rounded btn-sm" tabindex="0"
		aria-controls="#builder" type="button"
		onclick="parent.history.back();">
		<span class="fas fa-arrow-left"></span>
	</button>
	<!-- div class="pull-right">
		<button class="btn btn-info btn-sm" tabindex="0"
			aria-controls="#builder" type="button" name="completeTask"
			id="completeTask">
			<span class="fas">Complete</span>
		</button>
	</div-->

</div>

<div id="taskDetailsDiv">
	<div class="panel panel-default" style="padding: 5px;">

		<!-- div class="panel-heading">Task Completion Activity</div-->
		<div class="panel-body">

			<fieldset class="col-md-12">
				<legend>Task Details</legend>

				<div class="panel panel-default">
					<div class="panel-body">
						<!-- 1 -->
						<div class='row'>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Station ID: <b><?php echo $st_id;?></b>
									</p>
								</div>
							</div>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Station name:<b> <?php echo $row_st["name"];?></b>
									</p>
								</div>
							</div>

							<!-- 2 -->
						<div class='col-sm-4'>
								<div class='form-group'>
									<p>
										Reassigned to: <b><?php echo $row["reassigned_to"];?></b>
									</p>
								</div>
							</div>
							
							<div class='col-sm-4'>
								<div class='form-group'>
									<p>
										Maintenance Date & Time: <b><?php echo $row["start_date"];?></b>
									</p>
								</div>
							</div>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Task Name:<b><?php echo $row["name"];?></b>
									</p>
								</div>
							</div>
							<div class='col-sm-2'>
								<div class='form-group'>
									<p>
										Status:<b> <?php echo $row["status"];?></b>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>

			</fieldset>

			<div class="clearfix"></div>
		</div>

	</div>


	<div class="panel panel-default" style="padding: 10px;">

		<!-- div class="panel-heading">Task Completion Activity</div-->
		<div class="panel-body">

			<fieldset class="col-md-12">
				<legend>Checklist</legend>

				<div class="panel panel-default">
					<div class="panel-body">
						<div id='formio'></div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>

	<div id="ignoreContent"></div>
</div>


<?php
$checklist_content;
if (isset($_GET['id'])) {
    $id = stripslashes($_GET['id']);
    $id = mysqli_real_escape_string($con, $id);

    $checklist_id = $row['checklist_id'];
    
    $qry2 = "SELECT * from checklist where id='$checklist_id'";
    $result2 = mysqli_query($con, $qry2) or die(mysqli_error($con));
    $row2 = mysqli_fetch_assoc($result2);
    $checklist_content = $row2["checklist_content"]; 
    
    $station_id= $row2["station_id"];
    $station_id = mysqli_real_escape_string($con, $station_id);
    
    //echo $station_id.'1-----------';
    
    $qry3 = "SELECT * from stations where station_id='$station_id'";
    $result3 = mysqli_query($con, $qry3) or die(mysqli_error($con));
    $row3 = mysqli_fetch_assoc($result3);
    $project_id= $row3["projects_id"];
    $project_id = mysqli_real_escape_string($con, $project_id);
     
   // echo $project_id.'2----------'.$qry3;
    
    $qry4 = "SELECT * from projects where id='$project_id'";
    $result4 = mysqli_query($con, $qry4) or die(mysqli_error($con));
    $row4 = mysqli_fetch_assoc($result4);
    $project_manager= $row4["manager"];
    //echo $project_manager.$project_id.$qry4;
    
    // echo json_encode($template_content);
    // exit();
}
?>
 
<?php include '../doc/footer.php'; ?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>
<script src="../js/jquery.ba-throttle-debounce.js"></script>

<script>
$(document).ready( function() {

	

	var task_id = "<?php echo $id ?>"; 
	var project_manager = "<?php echo $project_manager?>";
	var checklist_id = "<?php echo $checklist_id?>";

	$('#completeTask').on('click', function(e){
    	//e.preventDefault(); 	            	
        $('#completeTask').unbind('click');                    
      $.ajax({
			type: "POST",
			url: "./task_actions",				
			data: {"action":"completeTask","task_id":task_id,"project_manager":project_manager,"checklist_id":checklist_id},
			success: function(res){
			console.log("approved task."+res);	
			//parent.history.back();	
			//location.reload(true);		
			if(res.indexOf('Error')!=-1){
				swal({
				  title: "Error",
				  text: res,
				  icon: "error",
				});	
				}	
            
			},error: function(resp){
				console.log("Error");
				console.log(resp);
			}
		});   		                   
		                          	
    });
    
var json = <?php echo $checklist_content;?>;

		
var maint_date = "<?php echo $maint_date;?>";
var status ="<?php echo $status;?>";
var task_name="<?php echo $task_name;?>";
var render = false;
console.log(status);
if(status =="Completed"){
	render = true;
}

//window.onload = function() {
	Formio.createForm(document.getElementById('formio'), json,{
		readOnly: render,			
	}).then(function(form) {
		
		  form.on('submit', (submission) => {
		 	  
			    console.log('The form was just submitted!!!');

			    var components = form.components;
			    var finalComp = new Array();
			    $(components).each(function(index, comp) {
			        var itemObj = new Array();
			        var compObj = new Object();
			        if (comp.label !== "Submit") {
			        	compObj.legend = comp.label;
			            var descs = comp.components;
			            var remarkObj;
			            $(descs).each(function(idx, desc) {
			                remarkObj = new Object();
			                remarkObj.description = desc.label;
			                if(desc.currentValue){
			                	remarkObj.currentValue = desc.currentValue;
			                }else{
			                	remarkObj.currentValue = desc.dataValue;
			                }	
			                itemObj.push(remarkObj);		                
			            });			           
			            compObj.components = itemObj;
			            finalComp.push(compObj);
			        }
			    });
							   
			      form.emit('submitDone', submission);
			  		    
			      $.ajax({
						type: "POST",
						url: "./submit_task",				
						data: {"completedData":JSON.stringify(finalComp),"checklist_id":checklist_id,
								"maint_date":maint_date,"project_manager":project_manager,"task_id":task_id,
								"task_name":task_name								
								},
						success: function(res){
						console.log("approved task."+res);	
						//location.reload(true);	
						parent.history.back();	
						},error: function(resp){
							console.log("Error");
							console.log(resp);
						}
					}); 
			        	
			        	    					    
			  });
				  form.on('error', (errors) => {
				    console.log('We have errors!');
				  })
		});
//  };

  function sendToServer() {
	    let pdf = new jsPDF('p', 'pt', 'a4');
	    pdf.html($("#taskDetailsDiv"), {
	        callback: function (pdf) {
	            let obj = {};
	            obj.pdfContent = pdf.output('datauristring');
	            var jsonData = JSON.stringify(obj);
	            $.ajax({
	                url: './savepdf',
	                type: 'POST',
	                contentType: 'application/json',
	                data: jsonData
	            });
	        }
	    });
	}
	
  function clpdf(){
	  var opt = {
    		  margin:       0.5,
    		  filename:     'myfile.pdf',
    		  image:        { type: 'jpeg', quality: 0.98 },
    		  html2canvas:  { scale: 2 },
    		  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    		};
	
    //var element = $('#taskDetailsDiv');
    var element = document.getElementById('taskDetailsDiv');
    var file = html2pdf().set(opt).from(element).output('datauristring').then(function(urld){			
			var jsonData = JSON.stringify(urld);
            $.ajax({
                url: './savepdf',
                type: 'POST',
                contentType: 'application/json',
                data: jsonData
            });
        });
    

  }

});
  	
</script>
