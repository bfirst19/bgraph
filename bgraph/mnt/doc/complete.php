<?php include '../doc/header.php'; ?>
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

require ('../config/db.php');
session_start();

// storing request (ie, get/post) global array to a variable
$requestData = $_REQUEST;

$id = $_GET['id'];

$query = "select * from tasks where id ='$id'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);
?>

<div>
	<button class="btn btn-primary btn-rounded" tabindex="0"
		aria-controls="#builder" type="button"
		onclick="parent.history.back();">
		<span class="fas fa-arrow-left"></span>
	</button>	
</div>

<div id="taskDetailsDiv" >
<div class="panel panel-default" style="padding: 10px;">

	<!-- div class="panel-heading">Task Completion Activity</div-->
	<div class="panel-body">

		<fieldset class="col-md-12">
			<legend>Task Details</legend>

			<div class="panel panel-default">
				<div class="panel-body">
					<!-- 1 -->
					<div class='row'>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Task ID: <b><?php echo $row["id"];?></b>
								</p>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Task Name:<b><?php echo $row["name"];?></b>
								</p>
							</div>
						</div>
						<div class='col-sm-8'>
							<div class='form-group'>
								<p>
									Number:<b> <?php echo $row["number"];?></b>
								</p>
							</div>
						</div>
					</div>
					<!-- 2 -->
					<div class='row'>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Maintenance Date: <b><?php echo $row["start_date"];?></b>
								</p>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Assigned to:<b> <?php echo $row["assigned_to"];?></b>
								</p>
							</div>
						</div>
					</div>

					<!-- 3 -->
					<div class='row'>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Created on:<b> <?php echo $row["create_date"];?></b>
								</p>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Created by:<b> <?php echo $row["created_by"];?></b>
								</p>
							</div>
						</div>
					</div>
					<!-- 4 -->
					<div class='row'>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Reassigned to:<b> <?php echo $row["reassinged_to"];?></b>
								</p>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Status:<b> <?php echo $row["status"];?></b>
								</p>
							</div>
						</div>
					</div>
					<!-- 5 -->
					<div class='row'>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Station id:<b> <?php echo $row["station_id"];?></b>
								</p>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class='form-group'>
								<p>
									Project:<b> <?php echo $row["project_id"];?></b>
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

require ('../config/db.php');
session_start();

$template_content;
if (isset($_GET['id'])) {
    $id = stripslashes($_GET['id']);
    $id = mysqli_real_escape_string($con, $id);

    $qry = "SELECT template_content from checklist_template where id='41'";
    $result = mysqli_query($con, $qry) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result)) {
        $template_content = $row["template_content"];
    }

    // echo json_encode($template_content);
    // exit();
}
?>
 
<?php include '../doc/footer.php'; ?>

<link rel='stylesheet' href='../formio/formio.full.min.css'>

<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script src='../formio/formio.full.min.js'></script>

<script>
$(document).ready( function() {

var json = <?php echo $template_content;?>;

window.onload = function() {
	Formio.createForm(document.getElementById('formio'), json).then(function(form) {
			 	  form.on('submit', (submission) => {
				    console.log('The form was just submitted!!!');
				    clpdf();				    					    
				  });
				  form.on('error', (errors) => {
				    console.log('We have errors!');
				  })
		});
  };

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